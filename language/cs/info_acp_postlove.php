<?php
/**
*
* newspage [Czech]
*
* @package language
* @version $Id$
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'POSTLOVE_CONTROL'	=> 'Oblíbené příspěvky',
	'POSTLOVE_USE_CSS'	=> 'Používat CSS z rozšíření',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Pro snadnější přizpůsobení rozšíření můžete zakázat načítání CSS stylů, které jsou jeho součástí a navrhnout si svůj vlastní styl. Pokud chcete používat vlastní obrázky, zaměřte se na <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Zobrazovat počet příspěvků, které se líbí tomuto uživateli.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Zobrazovat ve <code>viewtopic</code> počet příspěvků, které se uživateli líbí.',
	'POSTLOVE_SHOW_LIKED'	=> 'Zobrazovat počet příspěvků, které se líbí ostatním uživatelům.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Zobrazovat ve <code>viewtopic</code> počet příspěvků, které se uživatelům líbily.',

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
