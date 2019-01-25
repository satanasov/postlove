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
	'POSTLOVE_USER_LIKES'	=> 'Gebruiker vindt leuk',
	'POSTLOVE_USER_LIKED'	=> 'Gebruiker heeft leuk gevonden',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%s vindt je volgende bericht leuk:',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Iemand vindt een bericht van je leuk:',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>vindt</b> %3$s\'s bericht "%4$s" leuk in onderwerp "%5$s"',
	'POSTLOVE_LIST'	=> 'Vind ik leuk',
	'POSTLOVE_LIST_VIEW'	=> 'Toon lijst met alle "vind ik leuks"',

	// Ver 2.0
	'CLICK_TO_LIKE' 	=> 'click to like this post',
	'CLICK_TO_UNLIKE'   => 'click to unlike this post',
	'LOGIN_TO_LIKE_POST' => 'login to like this post',
	'CANT_LIKE_OWN_POST' => 'sorry, you cant like your own post',
	'POST_OF_THE_DAY'	=> 'Most liked posts',
	'POST_LIKES'		=> 'Liked',
	'POSTED_AT'			=> 'Posted',
	'LIKED_BY'			=> 'post liked by: ',
	'POSTED_BY'			=> 'Author',
	'LIKES_TODAY'   	=> array(
		1	=> 'Once today',
		2	=> '%d times today',
	),
	'LIKES_THIS_WEEK'   	=> array(
		1	=> 'Once this week',
		2	=> '%d times this week',
	),
	'LIKES_THIS_MONTH'  	 => array(
		1	=> 'Once this month',
		2	=> '%d times this month',
	),
	'LIKES_THIS_YEAR'   	=> array(
		1	=> 'Once this year',
		2	=> '%d times this year',
	),
	'LIKES_EVER'	   => array(
		1	=> 'Once in total',
		2	=> '%d times in total',
	),
	'POSTLOVE_HIDE' 			=> 'Hide Like icons and summaries',
));

