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

class ajaxify
{
	/**
	* Constructor
	* NOTE: The parameters of this method must match in order and type with
	* the dependencies defined in the services.yml file for this service.
	*
	* @param \phpbb\auth		$auth		Auth object
	* @param \phpbb\cache\service	$cache		Cache object
	* @param \phpbb\config	$config		Config object
	* @param \phpbb\db\driver	$db		Database object
	* @param \phpbb\request	$request	Request object
	* @param \phpbb\template	$template	Template object
	* @param \phpbb\user		$user		User object
	* @param \phpbb\content_visibility		$content_visibility	Content visibility object
	* @param \phpbb\controller\helper		$helper				Controller helper object
	* @param anavaro\postlove\controller\notifyhelper	$notifyhelper	Notification helper.
	* @param string			$root_path	phpBB root path
	* @param string			$php_ext	phpEx
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \phpbb\controller\helper $helper, \anavaro\postlove\controller\notifyhelper $notifyhelper,$root_path, $php_ext, $table_prefix)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->helper = $helper;
		$this->notifyhelper = $notifyhelper;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->table_prefix = $table_prefix;
	}

	public function base ($action, $post)
	{
		switch ($action)
		{
			case 'togle':
				//get state for the like
				$sql_array = array(
					'SELECT'	=> 'pl.timestamp as timestamp, p.topic_id as topic_id, p.poster_id as poster, p.post_subject as post_subject',
					'FROM'	=> array(
						POSTS_TABLE	=> 'p',
						$this->table_prefix . 'posts_likes'	=> 'pl'
					),
					'WHERE'	=> 'pl.post_id = p.post_id AND pl.post_id = ' . $post . ' AND pl.user_id = ' . $this->user->data['user_id']
				);
				$sql = $this->db->sql_build_query('SELECT', $sql_array);
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);
				if (!$row['timestamp'])
				{
					//so we don't have record for this user loving this post ... give some love!
					$sql = 'INSERT INTO ' . $this->table_prefix . 'posts_likes SET post_id = ' . $post . ', user_id = ' . $this->user->data['user_id'] . ', type = \'post\', timestamp = ' . time();
					$result = $this->db->sql_query($sql);
					$this->db->sql_freeresult($result);
					$sql = 'SELECT topic_id, poster_id, post_subject FROM ' . POSTS_TABLE . ' WHERE post_id = ' . $post;
					$result = $this->db->sql_query($sql);
					$row1 = $this->db->sql_fetchrow($result);
					$this->db->sql_freeresult($result);
					$this->notifyhelper->notify('add', $row1['topic_id'], $post, $row1['post_subject'], $row1['poster_id'] , $this->user->data['user_id']);
					$json_response = new \phpbb\json_response;
					$json_response->send(array(
						'togle_action'	=> 'add',
						'togle_post'	=> $post,
					));
				}
				else
				{
					//so we have a record ... and the user don't love it anymore!
					$sql = 'DELETE FROM ' . $this->table_prefix . 'posts_likes WHERE post_id = ' . $post . ' AND user_id = ' . $this->user->data['user_id'];
					$result = $this->db->sql_query($sql);
					$this->db->sql_freeresult($result);
					$this->notifyhelper->notify('remove', $row['topic_id'], $post, $row['post_subject'], $row['poster'], $this->user->data['user_id']);
					$json_response = new \phpbb\json_response;
					$json_response->send(array(
						'togle_action' => 'remove',
						'togle_post'	=> $post,
					));
				}
			break;
		}
	}
}
