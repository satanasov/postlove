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
	'POSTLOVE_USER_LIKES'	=> 'Al usuario le han gustado',
	'POSTLOVE_USER_LIKED'	=> 'El usuario ha gustado',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s le ha <b>gustado</b> su mensaje "%2$s"',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>liked</b> %3$s\'s post "%4$s" in topic "%5$s"',
	'POSTLOVE_LIST'	=> 'Likes',
	'POSTLOVE_LIST_VIEW'	=> 'Show list with all like actions',
));
