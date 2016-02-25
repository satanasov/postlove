<?php
/**
*
* @package Anavaro.com Post Love
* @copyright (c) 2013 Lucifer
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/

namespace anavaro\postlove\acp;

/**
* @package acp
*/

class acp_postlove_module
{
	function main($id, $mode)
	{
		global $db, $config, $template, $request, $user, $cache, $phpbb_root_path;

		//Define extension path (we will need it)
		$ext_path =  $phpbb_root_path . 'ext/anavaro/postlove/';

		$this->tpl_name = 'acp_postlove';
		$this->page_title = 'ACP_POSTLOVE';

		if ($request->is_set_post('submit'))
		{
			$postlove = $request->variable('poslove', array('' => ''));
			foreach ($postlove as $id => $var)
			{
				$config->set($id, $var);
			}
			trigger_error($user->lang('CONFIRM_MESSAGE', $this->u_action));
		}

		$template->assign_vars(array(
			'POST_LIKES'	=> ($config['postlove_show_likes'] == 1 ? true : false),
			'POST_LIKED'	=> ($config['postlove_show_liked'] == 1 ? true : false),
			'AUTHOR_LIKE'	=> ($config['postlove_author_like'] == 1 ? true : false),
		));
	}
}
