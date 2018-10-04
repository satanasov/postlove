<?php
/**
*
* @package Post Love
* @copyright (c) 2015-2018 v12Mike
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace anavaro\postlove\event;

define('SECONDS_PER_MINUTE',	60);
define('SECONDS_PER_HOUR',  	(SECONDS_PER_MINUTE * 60));
define('SECONDS_PER_DAY',   	(SECONDS_PER_HOUR * 24));

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class summary_listener implements EventSubscriberInterface
{
	/** @var \anavaro\postlove\core\postlovesummary */
	protected $functions;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	public function __construct(\phpbb\auth\auth $auth,
								\phpbb\config\config $config,
								\phpbb\cache\service $cache,
								\phpbb\content_visibility $content_visibility,
								\phpbb\db\driver\driver_interface $db,
								\phpbb\event\dispatcher_interface $dispatcher,
								\phpbb\template\template	$template,
								\phpbb\user	$user,
								\phpbb\language\language	$language,
								$phpbb_root_path,
								$php_ext,
								$table_prefix)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->cache = $cache;
		$this->content_visibility = $content_visibility;
		$this->db = $db;
		$this->dispatcher = $dispatcher;
		$this->template = $template;
		$this->user = $user;
		$this->language = $language;
		$this->root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		$this->table_prefix = $table_prefix;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.index_modify_page_title'  => 'index_page_summary',
			'core.viewforum_modify_page_title' => 'forum_page_summary',
		);
	}

	public function  index_page_summary($event)
	{
		// first check that this user wants to see Post Like
		$this->user->get_profile_fields($this->user->data['user_id']);
		if ($this->user->data['is_bot'] || // bots dont want to see this
			(isset($this->user->profile_fields['pf_postlove_hide']) && $this->user->profile_fields['pf_postlove_hide']) // user doesnt want
			)
		{
			return;
		}
		else
		{
			// get array of fora that this user may read
			$forum_ary = array();
			$forum_read_ary = $this->auth->acl_getf('f_read');

			// prune any forums that are hidden from this user
			foreach ($forum_read_ary as $forum_id => $allowed)
			{
				if ($allowed['f_read'])
				{
					$forum_ary[] = (int) $forum_id;
				}
			}

			// prune any duplicates
			$forum_ary = array_unique($forum_ary);


			if (!sizeof($forum_ary))
			{
				// no need to look any further
				return;
			}

			$this->build_summary_array($forum_ary, 'index');
		}
	}

	public function  forum_page_summary($event)
	{
		// first check that this user wants to see Post Like
		$this->user->get_profile_fields($this->user->data['user_id']);
		if  ($this->user->data['is_bot'] || // bots dont want to see this
			 (isset($this->user->profile_fields['pf_postlove_hide']) && $this->user->profile_fields['pf_postlove_hide']) // user doesnt want
			)
		{
			return;
		}
		else
		{
			$forum_ary = array();
			$forum_id = $event['forum_id'];
			$forum_ary[] = $forum_id;

			// if there are sub-forums, we need to include them
			if ($event['forum_data']['left_id'] != $event['forum_data']['right_id'] - 1)
			{
				$forum_read_ary = $this->auth->acl_getf('f_read');

				$sql = 'SELECT f.forum_id
					FROM ' . FORUMS_TABLE . " f
					WHERE f.parent_id = $forum_id";

				$result = $this->db->sql_query($sql);
				while ($forum_data = $this->db->sql_fetchrow($result))
				{
					// don't add forums that are hidden from this user
					if ($forum_read_ary[$forum_id]['f_read'] == 1)
					{
						$forum_ary[] = $forum_data['forum_id'];
					}
				}
				$this->db->sql_freeresult($result);

				// prune any duplicates
				$forum_ary = array_unique($forum_ary);
			}
			$this->build_summary_array($forum_ary, 'forum');
		}
	}


	function build_summary_array($forum_ary, $page_type)
	{

		$post_list = array();
		$post_list[] = '0'; //SQL needs dummy array member

		// build the array of most liked posts
		$day_begin_time = floor(time() / SECONDS_PER_DAY) * SECONDS_PER_DAY;
		$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_' . $page_type . '_most_liked_ever'],		2,  								'LIKES_EVER',   	$post_list);
		$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_' . $page_type . '_most_liked_this_year'],   $day_begin_time - SECONDS_PER_DAY * 366, 'LIKES_THIS_YEAR', 	$post_list);
		$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_' . $page_type . '_most_liked_this_month'],  $day_begin_time - SECONDS_PER_DAY * 31, 	'LIKES_THIS_MONTH', $post_list);
		$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_' . $page_type . '_most_liked_this_week'],   $day_begin_time - SECONDS_PER_DAY * 7,  'LIKES_THIS_WEEK',  $post_list);
		$post_list = $this->topposts_of_period($forum_ary, $this->config['postlove_' . $page_type . '_most_liked_today'],   	$day_begin_time - SECONDS_PER_DAY,  	'LIKES_TODAY',  	$post_list);

		$this->template->assign_vars(array(
			'S_MOSTLIKEDSUMMARYCOUNT'	=>  count($post_list) - 1,
			));
	}

	function topposts_of_period($forum_ary, $howmany, $period_start_time, $period_name, $post_list)
	{
		if ($howmany == 0)
		{
			// configuration says we don't need to look for any in this period
			return $post_list;
		}

		// find all the visible, liked posts in the given period
		$sql = 'SELECT '. USERS_TABLE . '.user_id, '. USERS_TABLE . '.username, '. USERS_TABLE . '.user_colour,
			' . TOPICS_TABLE . '.topic_title, ' . TOPICS_TABLE . '.forum_id, ' . TOPICS_TABLE . '.topic_id,
			most_liked_posts.post_id, most_liked_posts.post_time, ' . TOPICS_TABLE . '.topic_type,
			' . FORUMS_TABLE	. '.forum_name, sum_likes
			FROM (
				SELECT ' . POSTS_TABLE . '.forum_id, ' . POSTS_TABLE . '.post_id, ' . POSTS_TABLE . '.post_time, ' . POSTS_TABLE . '.topic_id, ' . POSTS_TABLE . '.poster_id, sum_likes
				FROM(
					SELECT post_id AS post, COUNT(*) AS sum_likes
					FROM ' . $this->table_prefix . 'posts_likes
						WHERE ' . $this->table_prefix . 'posts_likes.timestamp > ' . $period_start_time .
						' AND post_id NOT IN (' . implode(",", $post_list) . ')
						GROUP BY post_id
					) AS liked_posts
			LEFT JOIN ' . POSTS_TABLE .   ' ON post = post_id
			WHERE  ' . $this->content_visibility->get_forums_visibility_sql('post', $forum_ary, POSTS_TABLE .'.') .
			' ORDER BY sum_likes DESC, post_time DESC
			LIMIT ' . $howmany .
			' )AS most_liked_posts
		LEFT JOIN ' . TOPICS_TABLE .  ' ON most_liked_posts.topic_id = '  . TOPICS_TABLE . '.topic_id
		LEFT JOIN ' . USERS_TABLE .   ' ON most_liked_posts.poster_id = ' . USERS_TABLE .  '.user_id
		LEFT JOIN ' . FORUMS_TABLE .  ' ON ' . TOPICS_TABLE . '.forum_id = '  . FORUMS_TABLE . '.forum_id
		WHERE topic_status <> ' . ITEM_MOVED ;

		// cache the query to reduce load on server
		// the same query is run for all users with the same set of forum permissions
		$result = $this->db->sql_query_limit($sql, $howmany, 0, (SECONDS_PER_HOUR * 12) - 1);

		$forums = $topic_ids = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$post_list[] = $row['post_id'];
			$topic_ids[] = $row['topic_id'];
			$forums[$row['forum_id']][] = $row['topic_id'];
		}

		// Get topic tracking
		$topic_tracking_info = array();
		foreach ($forums as $forum_id => $topic_id)
		{
			$topic_tracking_info[$forum_id] = get_complete_topic_tracking($forum_id, $topic_id);
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
			$is_guest = ($row['user_id'] == ANONYMOUS) ? true : false;

			$tpl_ary = array(
				'U_TOPIC'   		=> $view_post_url,
				'U_FORUM'   		=> $forum_name_url,
				'S_UNREAD'  		=> $post_unread,
				'USERNAME_FULL' 	=> get_username_string('full', $row['user_id'], $row['username'], $row['user_colour']),
				'POST_TIME' 		=> $this->user->format_date($row['post_time']),
				'TOPIC_TITLE'   	=> $topic_title,
				'FORUM_NAME'		=> $forum_name,
				'POST_LIKES_IN_PERIOD'  => $this->language->lang($period_name, $row['sum_likes'] +0),
				'LIKES_IN_PERIOD'   => $row['sum_likes'] + 0,
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

			$this->template->assign_block_vars('most_liked_posts', $tpl_ary);
		}
		$this->db->sql_freeresult($result);
		return $post_list;
	}
}
