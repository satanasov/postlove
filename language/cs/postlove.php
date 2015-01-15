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
	'POSTLOVE_USER_LIKES'	=> 'Uživateli se líbí',
	'POSTLOVE_USER_LIKED'	=> 'Uživatel se líbí',
	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s <b>se líbí</b> váš příspěvek „%2$s“',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Oblíbené příspěvky',
));
