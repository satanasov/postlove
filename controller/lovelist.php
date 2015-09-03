<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 Lucifer <http://www.anavaro.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\postlove\controller;

class lovelist
{
	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\auth\auth */
	protected $auth;

	/* @var \phpbb\user_loader */
	protected $user_loader;
	
	/* @var \phpbb\template\template */
	protected $template;

	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	*
	* @param \phpbb\user		$user		User object
	*/
	public function __construct(\phpbb\user $user, \phpbb\controller\helper $helper, \phpbb\db\driver\driver_interface $db, \phpbb\auth\auth $auth, \phpbb\user_loader $user_loader,
	\phpbb\template\template $template,
	$table_prefix, $root_path)
	{
		$this->user = $user;
		$this->helper = $helper;
		$this->db = $db;
		$this->auth = $auth;
		$this->user_loader = $user_loader;
		$this->template = $template;
		$this->table_prefix = $table_prefix;
		$this->root_path = $root_path;
	}

	/**
	* Post love list
	*	Route: postlove/{user_id}
	*
	* @param int	$user_id	User ID
	* @return Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function base ($user_id)
	{
		// Add lang
		$this->user->add_lang_ext('anavaro/postlove', array('postlove'));
		// Let's get allowed forums
		// Get the allowed forums
		$forum_ary = array();
		$forum_read_ary = $this->auth->acl_getf('f_read');
		foreach ($forum_read_ary as $forum_id => $allowed)
		{
			if ($allowed['f_read'])
			{
				$forum_ary[] = (int)$forum_id;
			}
		}
		$forum_ids = array_unique($forum_ary);
		// No forums with f_read
		if (!sizeof($forum_ids))
		{
			return;
		}

		$sql_array = array(
			'SELECT'	=> 'pl.timestamp as timestamp, pl.user_id as liker_id, p.post_id as post_id, p.topic_id as topic_id, p.poster_id as poster, p.post_subject as post_subject, t.topic_title as topic_title',
			'FROM'	=> array(
				POSTS_TABLE	=> 'p',
				TOPICS_TABLE	=> 't',
			),
			'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array($this->table_prefix . 'posts_likes'	=> 'pl'),
					'ON'	=> 'pl.post_id = p.post_id'
				),
			),
			'WHERE'	=> 'p.topic_id = t.topic_id AND (p.poster_id = ' . $user_id . ' OR  pl.user_id = ' . $user_id . ') AND pl.user_id > 0 AND ' . $this->db->sql_in_set('p.forum_id', $forum_ids),
			'ORDER_BY'	=> 'pl.timestamp DESC'
		);
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query_limit($sql, 0, 100);
		$users = $output = $raw_output = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			if ($row['liker_id'] != $user_id)
			{
				$users[] = $row['liker_id'];
			}
			if ($row['poster'] != $user_id)
			{
				$users[] = $row['poster'];
			}
			$raw_output[] = $row;
		}
		$users[] = $user_id;
		$users = array_unique($users);
		$this->db->sql_freeresult($result);
		$this->user_loader->load_users($users);
		foreach ($raw_output as $row)
		{
			$post_link = '<a href="' . $this->root_path .'../viewtopic.php?p=' . $row['post_id'] . '#'. $row['post_id'] .'" target="_blank" >' . $row['post_subject'] . '</a>';
			$topic_link = '<a href="' . $this->root_path .'../viewtopic.php?t=' . $row['topic_id'] . '" target="_blank" class="topictitle">' . $row['topic_title'] . '</a>';
			$this->template->assign_block_vars('lovelist', array(
				'LINE' => $this->user->lang('LIKE_LINE', $this->user->format_date($row['timestamp']), $this->user_loader->get_username($row['liker_id'], 'full'), $this->user_loader->get_username($row['poster'], 'full'), $post_link, $topic_link),
			));
		}

		$page_title = 'test';
		return $this->helper->render('postlove_base.html', $page_title);
	}
}