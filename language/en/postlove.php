<?php

/**
*
* newspage [English]
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
	'POSTLOVE_USER_LIKES'	=> 'User likes',
	'POSTLOVE_USER_LIKED'	=> 'User is liked',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%s <b>liked</b> your post:',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Liked posts.',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>liked</b> %3$s’s post “%4$s” in topic “%5$s”',
	'POSTLOVE_LIST'	=> 'Likes',
	'POSTLOVE_LIST_VIEW'	=> 'Show list with all like actions',
));
