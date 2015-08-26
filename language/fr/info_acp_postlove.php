<?php

/**
*
* @package Post Love [French]
* @translated into French by Galixte (http://www.galixte.com)
*
* @copyright (c) 2014
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'POSTLOVE_CONTROL'	=> '« J’aime » un message',
	'POSTLOVE_USE_CSS'	=> 'Utiliser le CSS fourni',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Afin de personnaliser aisément l’extension POST LOVE il est possible de ne plus utiliser le CSS par défaut. Si vous souhaitez utiliser vos propres images, veuillez vous référer au fichier : <code>overall_header_head_append.html</code>.',
	'POSTLOVE_SHOW_LIKES'	=> 'Afficher le nombre de « J’aime » que l’utilisateur a partagé',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Afficher dans <code>viewtopic</code> le nombre de messages que l’utilisateur a aimé, sous forme de « J’aime ».',
	'POSTLOVE_SHOW_LIKED'	=> 'Afficher le nombre de « J’aime » pour les messages de l’utilisateur',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Afficher dans <code>viewtopic</code> le nombre de messages de l’utilisateur aimés par les autres, sous forme de « J’aime ».',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'	=> 'Post love',
	'POSTLOVE_EXPLAIN'	=> 'From here you can change some Post Love settings',
	'CONFIRM_MESSAGE'	=> 'Changes saved!<br><br><a href="%1$s">Back</а>',
	'POSTLOVE_CURRENT_THEME'	=> 'Current theme',
	'THEME_NAME'	=> 'Theme name',
	'THEME_AUTHOR'	=> 'Theme author',
	'THEME_DESCRIPTION'	=> 'Theme description',
	'THEME_SUPPORT_STYLES'	=> 'Supported styles',
	'THEME_PREVIEW'	=> 'Preview',
	'POSTLOVE_CHOOSE_THEME' => 'Select theme',

	'POSTLOVE_NO_THEMES_INSTALLED'	=> 'There are no themes installed!<br>Please add them in <i>$phpbb_root_path/ext/anavaro/postlove/themes</i> folder',
	'THEME_CHANGED'	=> 'Theme changed',
	'POSTLOVE_NO_WRITE_ACTION'	=> 'No write acccess!<br>Please allow write access to<i> $phpbb_root_path/ext/anavaro/postlove/styles </i>folder',
));
