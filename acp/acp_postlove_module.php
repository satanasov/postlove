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

		if ($request->is_set_post('apply'))
		{
			if (is_writable($ext_path . 'styles'))
			{
				$theme_to_apply = $request->variable('poslove_choose', '');
				// Delete old files
				$dirs = array_diff(scandir($ext_path . 'styles/'), array('..', '.'));
				foreach (glob("{$ext_path}styles/*") as $var)
				{
					if (is_dir($var))
					{
						$this->recursiveRemoveDirectory($var);
					}
					else
					{
						unlink($var);
					}
				}
				$this->recurse_copy($ext_path . 'themes/' . $theme_to_apply, $ext_path . 'styles');
				$config->set('postlove_installed_theme', $theme_to_apply);
				$cache->purge();

				trigger_error($user->lang('THEME_CHANGED'));
			}
		}

		// Let's populate installed current theme info
		$string = file_get_contents($ext_path . 'themes/' . $config['postlove_installed_theme'] . '/' . $config['postlove_installed_theme'] . '.json');
		$theme_json = json_decode($string, true);

		$template->assign_vars(array(
			'POST_LIKES'	=> ($config['postlove_show_likes'] == 1 ? true : false),
			'POST_LIKED'	=> ($config['postlove_show_liked'] == 1 ? true : false),
			'AUTHOR_LIKE'	=> ($config['postlove_author_like'] == 1 ? true : false),
			'INSTALLED_THEME_NAME'	=> $theme_json['name'],
			'INSTALLED_THEME_AUTHOR'	=> $theme_json['author'],
			'INSTALLED_THEME_DESCRIPTION'	=> $theme_json['description'],
			'INSTALLED_THEME_SUPPORTED_STYLES'	=> implode(',', $theme_json['support']),
			'INSTALLED_THEME_PREVIEW'	=> $ext_path . 'themes/' . $config['postlove_installed_theme'] . '/' . $theme_json['preview'],
		));

		// Test folder writable, if not - BREAK!
		if (is_writable($ext_path . 'styles'))
		{
			// Let's populate new themes selector
			$themes = array_diff(scandir($ext_path . 'themes/'), array('..', '.', $config['postlove_installed_theme']));
			foreach ($themes as $var)
			{
				if (file_exists($ext_path . 'themes/' . $var . '/' . $var . '.json'))
				{
					$string = file_get_contents($ext_path . 'themes/' . $var . '/' . $var . '.json');
					$theme_json = json_decode($string, true);
					$template->assign_block_vars('themeselector', array(
						'THEME_STRING'	=> $var,
						'THEME_NAME'	=> $theme_json['name'],
						'THEME_AUTHOR'	=> $theme_json['author'],
						'THEME_DESCRIPTION' => $theme_json['description'],
						'THEME_SUPPORTED'	=> implode(',', $theme_json['support']),
						'THEME_PREVIEW'	=> (isset($theme_json['preview']) ? '<img src="' . $ext_path . 'themes/' . $var . '/' . $theme_json['preview'] . '" style="max-width: 100%"/>' : false),
					));
				}
			}
		}
		else
		{
			$template->assign_vars(array(
				'WRITE_ERROR'	=> true,
			));
		}
	}

	// Easy way to clean styles and to recreate it.
	function recursiveRemoveDirectory($directory)
	{
		foreach (glob("{$directory}/*") as $file)
		{
			if (is_dir($file))
			{
				$this->recursiveRemoveDirectory($file);
			}
			else
			{
				unlink($file);
			}
		}
		rmdir($directory);
	}

	// Recurse copy
	function recurse_copy($src, $dst)
	{
		$dir = opendir($src);
		@mkdir($dst);
		while (false !== ($file = readdir($dir)))
		{
			if (( $file != '.' ) && ( $file != '..' ))
			{
				if ( is_dir($src . '/' . $file) )
				{
					$this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else
				{
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
}
