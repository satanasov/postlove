<?php

/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 Lucifer <http://www.anavaro.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\postlove\event;

/**
* Event listener
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{	
	static public function getSubscribedEvents()
    {
		return array(
			'core.viewtopic_modify_post_row'	=>	'modify_post_row',
		);
    }
	
	
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
	* @param string			$root_path	phpBB root path
	* @param string			$php_ext	phpEx
	*/
	public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\service $cache, \phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \phpbb\controller\helper $helper, $root_path, $php_ext, $table_prefix)
	{
		$this->auth = $auth;
		$this->cache = $cache;
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->helper = $helper;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		$this->table_prefix = $table_prefix;
	}
	
	protected $image_dir = 'ext/anavaro/postlove/images';

	public function modify_post_row($event)
	{
		//var_dump($event['row']['post_id']);
		$image = $likes = '';
		$isliked = false;
		$likers = array();
		$sql_array = array(
			'SELECT'	=>	'pl.user_id as user_id, u.username as username',
			'FROM'	=> array(
				USERS_TABLE	=> 'u',
				$this->table_prefix . 'posts_likes'	=> 'pl'
			),
			'WHERE'	=> 'u.user_id = pl.user_id AND post_id = '.$event['row']['post_id'],
			'ORDER_BY'	=> 'pl.timestamp ASC',
		);
		
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$likers[$row['user_id']] = $row['username'];
			if ($row['user_id'] == $this->user->data['user_id'])
			{
				$isliked = true;
			}
		}
		if (!empty($likers))
		{
			global $user;

			if ($event['row']['user_id'] != ANONYMOUS)
			{
				$post_row = $event['post_row'];
				
				//let's take the list of peoples that liked this post
				$post_likers = implode(', ', $likers);
				$post_row['POST_LIKERS'] = $post_likers;
				
				//let's get the number
				$post_likers_number = count($likers);
				$post_row['POST_LIKERS_COUNT'] = $post_likers_number;
				
				//now the image
				$post_like_class = ($isliked ? 'liked' : 'like');
				$post_row['POST_LIKE_CLASS'] = $post_like_class;
				
				$event['post_row'] = $post_row;
			}
		}
		else
		{
			$post_row = $event['post_row'];
			$post_row['POST_LIKERS_COUNT'] = '0';
			$post_row['POST_LIKE_CLASS'] = 'like';
			$event['post_row'] = $post_row;
		}
		$this->template->assign_var('IMGDIR', $this->image_dir);
		$this->template->assign_var('IS_POSTROW', '1');
		if ($this->user->data['is_bot'] && $this->user->data['user_id'])
		{
			$this->template->assign_var('DISABLE', '1');
		}
	}
	
}
