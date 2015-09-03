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

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>liked</b> %3$s\'s post "%4$s" in topic "%5$s"',
	'POSTLOVE_LIST'	=> 'Likes',
	'POSTLOVE_LIST_VIEW'	=> 'Show list with all like actions',
));
