<?php

/**
*
* newspage [Dutch]
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
	'POSTLOVE_USER_LIKES'	=> 'Gebruiker vind leuk',
	'POSTLOVE_USER_LIKED'	=> 'Gebruiker leuk gevonden',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s vind je post "%2$s" leuk!',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Iemand vind een post van je leuk',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>liked</b> %3$s\'s post "%4$s" in topic "%5$s"',
	'POSTLOVE_LIST'	=> 'Likes',
	'POSTLOVE_LIST_VIEW'	=> 'Show list with all like actions',
));
