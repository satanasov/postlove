<?php

/**
*
* newspage [Polish]
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
	'POSTLOVE_USER_LIKES'	=> 'Posty, które użytkownik polubił',
	'POSTLOVE_USER_LIKED'	=> 'Posty użytkownika, które polubiono',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%s <b>polubił(a)</b> Twój post:',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Polubiono post',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>polubił(a)</b> post użytkownika %3$s: "%4$s" w temacie "%5$s"',
	'POSTLOVE_LIST'	=> 'Polubienia',
	'POSTLOVE_LIST_VIEW'	=> 'Pokaż listę wszystkich polubień',

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

