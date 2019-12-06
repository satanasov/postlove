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
	'CLICK_TO_LIKE' 	=> 'kliknij, by polubić ten post',
	'CLICK_TO_UNLIKE'   => 'kliknij, by odlubić ten post',
	'LOGIN_TO_LIKE_POST' => 'zaloguj się, by polubić ten post',
	'CANT_LIKE_OWN_POST' => 'niestety, nie możesz polubić tego posta',
	'POST_OF_THE_DAY'	=> 'Najbardziej lubiane posty',
	'POST_LIKES'		=> 'Polubiony',
	'POSTED_AT'			=> 'Umieszczony',
	'LIKED_BY'			=> 'post polubiony przez: ',
	'POSTED_BY'			=> 'Autor',
	'LIKES_TODAY'   	=> array(
		1	=> 'Jeden raz dzisiaj',
		2	=> '%d razy dzisiaj',
	),
	'LIKES_THIS_WEEK'   	=> array(
		1	=> 'Raz w tym tygodniu',
		2	=> '%d razy w tym tygodniu',
	),
	'LIKES_THIS_MONTH'  	 => array(
		1	=> 'Raz w tym miesiącu',
		2	=> '%d razy w tym tygodniu',
	),
	'LIKES_THIS_YEAR'   	=> array(
		1	=> 'Raz year',
		2	=> '%d razy w tym roku',
	),
	'LIKES_EVER'	   => array(
		1	=> 'Tylko raz ogółem',
		2	=> '%d razy ogółem',
	),
	'POSTLOVE_HIDE' 			=> 'Ukryj polubienia i podsumowanie',
));
