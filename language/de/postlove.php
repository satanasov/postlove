<?php

/**
*
* Postlove [German]
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
	'POSTLOVE_USER_LIKES'	=> 'User gefallen',
	'POSTLOVE_USER_LIKED'	=> 'User gefällt',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s <b>gefällt</b> dein Beitrag "%2$s"',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Beitrag gefällt.',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>gefällt</b> %3$s\'s Beitrag "%4$s" im Thema "%5$s"',
	'POSTLOVE_LIST'	=> 'Gefällt',
	'POSTLOVE_LIST_VIEW'	=> 'Zeige Liste mit allen Gefällt-Angaben',

	// Ver 2.0
	'CLICK_TO_LIKE' 	=> 'Mir gefällt dieser Beitrag',
	'CLICK_TO_UNLIKE'   => 'Mir gefällt dieser Beitrag nicht',
	'LOGIN_TO_LIKE_POST' => 'Einloggen, um diesen Beitrag zu liken',
	'CANT_LIKE_OWN_POST' => 'Sorry, du kannst nicht deinen eigenen Beitrag liken.',
	'POST_OF_THE_DAY'	=> 'Beitrag des Tages',
	'POST_LIKES'		=> 'Liked',
	'POSTED_AT'			=> 'Geposted am',
	'LIKED_BY'			=> 'Beitrag finden gut: ',
	'POSTED_BY'			=> 'Autor',
	'LIKES_TODAY'   	=> array(
		1	=> '1 heute',
		2	=> '%d heute',
	),
	'LIKES_THIS_WEEK'   	=> array(
		1	=> '1 in dieser Woche',
		2	=> '%d in dieser Woche',
	),
	'LIKES_THIS_MONTH'  	 => array(
		1	=> '1 diesen Monat',
		2	=> '%d diesen Monat',
	),
	'LIKES_THIS_YEAR'   	=> array(
		1	=> '1 dieses Jahr',
		2	=> '%d dieses Jahr',
	),
	'LIKES_EVER'	   => array(
		1	=> '1 insgesamt',
		2	=> '%d insgesamt',
	),
	'POSTLOVE_HIDE' 			=> 'Blende Like-Icon und Statistik aus',
));
