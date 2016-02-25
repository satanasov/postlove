<?php
/**
*
* @package Post Love
* @copyright (c) 2014 RMcGirr83, (c) 2015 v12Mike
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace anavaro\postlove\event;

define('SECONDS_PER_MINUTE',	60);
define('SECONDS_PER_HOUR',  	SECONDS_PER_MINUTE * 60);
define('SECONDS_PER_DAY',   	SECONDS_PER_HOUR * 24);

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class postoftheday_listener implements EventSubscriberInterface
{
	/** @var \anavaro\postlove\core\postoftheday */
	protected $functions;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\cache\service $cache, \phpbb\content_visibility $content_visibility, \phpbb\db\driver\driver_interface $db, \phpbb\event\dispatcher_interface $dispatcher, \phpbb\template\template	$template,	\phpbb\user	$user,	$phpbb_root_path,	$php_ext, $table_prefix)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->cache = $cache;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->dispatcher = $dispatcher;
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->table_prefix = $table_prefix;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.index_modify_page_title'  => 'potd_index_page',
			'core.viewforum_modify_topics_data' => 'potd_forum_page',
		);
	}

	public function  potd_index_page($event)
	{
		$post_list = array();
		$post_list[] = '0'; //SQL needs dummy array member

		// first check that this user wants to see Post Like
		$this->user->get_profile_fields($this->user->data['user_id']);
		if (!(isset($this->user->profile_fields['pf_postlove_hide']) && $this->user->profile_fields['pf_postlove_hide']))
		{
			// get array of fora that this user may read
			$forum_ary = array();
			$forum_read_ary = $this->auth->acl_getf('f_read');

			foreach ($forum_read_ary as $forum_id => $allowed)
			{
				if ($allowed['f_read'])
				{
					$forum_ary[] = (int) $forum_id;
				}
			}
			$forum_ary = array_unique($forum_ary);

			if (!sizeof($forum_ary))
			{
				// no need to look any further
				return;
			}

			// build the template array of most liked posts
			$now = time();
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_index_most_liked_ever'], 2, 'LIKES_EVER', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_index_most_liked_this_year'], $now - SECONDS_PER_DAY * 366, 'LIKES_THIS_YEAR', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_index_most_liked_this_month'], $now - SECONDS_PER_DAY * 31, 'LIKES_THIS_MONTH', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_index_most_liked_this_week'], $now - SECONDS_PER_DAY * 7, 'LIKES_THIS_WEEK', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_index_most_liked_today'], $now - SECONDS_PER_DAY, 'LIKES_TODAY', $post_list);

			$this->template->assign_vars(array(
				'S_POSTOFTHEDAY'	=>  count($post_list) - 1,
				));
		}
	}

	public function  potd_forum_page($event)
	{
		// first check that this user wants to see Post Like
		$this->user->get_profile_fields($this->user->data['user_id']);
		if (!(isset($this->user->profile_fields['pf_postlove_hide']) && $this->user->profile_fields['pf_postlove_hide']))
		{
			$post_list = array();
			$post_list[] = '0'; //SQL needs dummy array member
			$forum_ary = array();
			$topic_list = array();
			$topic_list = $event['topic_list'];
			$forum_ary[0] = $event['forum_id'];

			// build the template array of most liked posts
			$now = time();
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_forum_most_liked_ever'], 2, 'LIKES_EVER', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_forum_most_liked_this_year'], $now - SECONDS_PER_DAY * 366, 'LIKES_THIS_YEAR', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_forum_most_liked_this_month'], $now - SECONDS_PER_DAY * 31, 'LIKES_THIS_MONTH', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_forum_most_liked_this_week'], $now - SECONDS_PER_DAY * 7, 'LIKES_THIS_WEEK', $post_list);
			$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_forum_most_liked_today'], $now - SECONDS_PER_DAY, 'LIKES_TODAY', $post_list);

			$this->template->assign_vars(array(
				'S_POSTOFTHEDAY'	=>  count($post_list) - 1,
				));
		}
	}

	function topposts_of_period($forum_ary, $howmany, $time_threshold, $period_name, $post_list)
	{
		$tpl_loopname = 'post_of_the_day';

		if ($howmany == 0)
		{
			// configuration says we don't need to look for any for this period
			return $post_list;
		}

		// calculate the timestamp that we are interested in
		// floor to an even hour to improve sql caching performance
		$time_threshold = $time_threshold - ($time_threshold % SECONDS_PER_HOUR);

		// find all the visible, liked posts in the given period
		$sql = 'SELECT '. USERS_TABLE . '.user_id, '. USERS_TABLE . '.username, '. USERS_TABLE . '.user_colour, ' . TOPICS_TABLE .
			'.topic_title, ' . TOPICS_TABLE . '.forum_id, ' . TOPICS_TABLE . '.topic_id, ' . POSTS_TABLE . '.post_id, ' . POSTS_TABLE .
			'.post_time, ' . TOPICS_TABLE .	'.topic_last_poster_name, ' . TOPICS_TABLE . '.topic_type, ' . FORUMS_TABLE	. '.forum_name, sum_likes
			FROM (
				SELECT post_id AS post, COUNT(*) AS sum_likes
				FROM ' . $this->table_prefix . 'posts_likes 
				WHERE ' . $this->table_prefix . 'posts_likes.timestamp > ' . $time_threshold . '
				AND post_id NOT IN (' . implode(",", $post_list) . ')
				GROUP BY post_id 
				ORDER BY sum_likes DESC
			) AS liked_posts
			LEFT JOIN ' . POSTS_TABLE .   ' ON post = post_id
			LEFT JOIN ' . TOPICS_TABLE .  ' ON ' . POSTS_TABLE .  '.topic_id = '  . TOPICS_TABLE . '.topic_id
			LEFT JOIN ' . USERS_TABLE .   ' ON ' . POSTS_TABLE .  '.poster_id = ' . USERS_TABLE .  '.user_id
			LEFT JOIN ' . FORUMS_TABLE .  ' ON ' . TOPICS_TABLE . '.forum_id = '  . FORUMS_TABLE . '.forum_id
			WHERE  ' . $this->content_visibility->get_forums_visibility_sql('post', $forum_ary, POSTS_TABLE .'.') .
			' AND topic_status <> ' . ITEM_MOVED .
			' ORDER BY sum_likes DESC, post_time DESC';

		// cache the query for a short time to reduce load on busy servers
		// the same query is run for all users with the same set of forum permissions
		$result = $this->db->sql_query_limit($sql, $howmany, 0, $this->config['postlove_summary_query_cache_seconds']);

		$forums = $ga_topic_ids = $topic_ids = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$post_list[] = $row['post_id'];
			$topic_ids[] = $row['topic_id'];
			if ($row['topic_type'] == POST_GLOBAL)
			{
				$ga_topic_ids[] = $row['topic_id'];
			}
			else
			{
				$forums[$row['forum_id']][] = $row['topic_id'];
			}
		}

		// Get topic tracking
		$topic_tracking_info = array();
		foreach ($forums as $forum_id => $topic_id)
		{
			$topic_tracking_info[$forum_id] = get_complete_topic_tracking($forum_id, $topic_id, $ga_topic_ids);
		}

		$this->db->sql_rowseek(0, $result);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$topic_id = $row['topic_id'];
			$forum_id = $row['forum_id'];
			$forum_name = $row['forum_name'];

			$post_unread = (isset($topic_tracking_info[$forum_id][$topic_id]) && $row['post_time'] > $topic_tracking_info[$forum_id][$topic_id]) ? true : false;
			$view_post_url = append_sid("{$this->root_path}viewtopic.$this->php_ext", 'f=' . $row['forum_id'] . '&amp;t=' . $row['topic_id'] . '&amp;p=' . $row['post_id'] . '#p' . $row['post_id']);
			$forum_name_url = append_sid("{$this->root_path}viewforum.$this->php_ext", 'f=' . $row['forum_id']);
			$topic_title = censor_text($row['topic_title']);
			if (utf8_strlen($topic_title) >= 60)
			{
				$topic_title = (utf8_strlen($topic_title) > 60 + 3) ? utf8_substr($topic_title, 0, 60) . '...' : $topic_title;
			}
			$is_guest = ($row['user_id'] == ANONYMOUS) ? true : false;

			$tpl_ary = array(
				'U_TOPIC'   		=> $view_post_url,
				'U_FORUM'   		=> $forum_name_url,
				'S_UNREAD'  		=> ($post_unread) ? true : false,
				'USERNAME_FULL' 	=> ($is_guest || !$this->auth->acl_get('u_viewprofile')) ?
											$this->user->lang['POST_BY_AUTHOR'] . ' ' . get_username_string('no_profile', $row['user_id'], $row['username'], $row['user_colour'], $row['topic_last_poster_name']) :
											$this->user->lang['POST_BY_AUTHOR'] . ' ' . get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'POST_TIME' 		=> $this->user->format_date($row['post_time']),
				'TOPIC_TITLE'   	=> $topic_title,
				'FORUM_NAME'		=> $forum_name,
				'POST_LIKES_IN_PERIOD' => $this->user->lang($period_name, $row['sum_likes'] + 0),
			);
			/**
			* Modify the topic data before it is assigned to the template
			*
			* @event anavaro.postlove.modify_tpl_ary
			* @var  array   row 		Array with topic data
			* @var  array   tpl_ary 	Template block array with topic data
			* @since 1.0.0
			*/
			$vars = array('row', 'tpl_ary');
			extract($this->dispatcher->trigger_event('anavaro.postlove.modify_tpl_ary', compact($vars)));

			$this->template->assign_block_vars($tpl_loopname, $tpl_ary);
		}
		$this->db->sql_freeresult($result);
		return $post_list;
	}
}
