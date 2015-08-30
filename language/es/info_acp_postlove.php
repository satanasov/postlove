<?php

/**
*
* newspage [Spanish]
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
	'POSTLOVE_CONTROL'	=> 'Mensaje que gusta',
	'POSTLOVE_USE_CSS'	=> 'Usar CSS proporcionado',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Para facilitar la personalización de la extensión POST LOVE, podría evitar la carga del CSS por defecto. Si desea utilizar sus propias imágenes, por favor, consulte el archivo <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Mostrar el número de mensajes que le han gustado.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Mostrar en <code>viewtopic</code> el número de mensajes que han gustado a este usuario.',
	'POSTLOVE_SHOW_LIKED'	=> 'Mostrar el número de mensajes que han gustado.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Mostrar en <code>viewtopic</code> cuántos mensajes del usuario han gustado a los demás.',

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

	'POSTLOVE_AUTHOR_LIKE'	=> 'Author can like posts',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Can the author like his/her own posts or not',
));
