<?php

/**
*
* Post Love [Polish]
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
	'POSTLOVE_CONTROL'	=> 'Polubienia postów',
	'POSTLOVE_USE_CSS'	=> 'Użyj dostarczonych stylów CSS',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Aby łatwiej spersonalizować rozszerzenie POST LOVE, możesz zatrzymać wczytywanie go z domyślnego stylu CSS. Jeśli chcesz użyć własnych grafik, przejdź do pliku <code>overall_header_head_append.html</code>.',
	'POSTLOVE_SHOW_LIKES'	=> 'Pokaż sumę postów, jakie zostały polubione przez tego użytkownika',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Pokazuje w <code>viewtopic</code> sumę postów, jakie zostały polubione przez tego użytkownika.',
	'POSTLOVE_SHOW_LIKED'	=> 'Pokaż sumę postów tego użytkownika, jakie zostały polubione przez innych',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Pokazuje w <code>viewtopic</code> sumę postów tego użytkownika, jakie zostały polubione przez innych.',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'	=> 'Polubienia postów',
	'POSTLOVE_EXPLAIN'	=> 'Z tego miejsca możesz zmienić ustawienia rozszerzenia Post Love',
	'CONFIRM_MESSAGE'	=> 'Zmiany zostały zapisane pomyślnie!<br><br><a href="%1$s">Powrót</а>',

	'POSTLOVE_AUTHOR_LIKE'	=> 'Autor może polubić swoje posty',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Określa, czy autor postu może polubić swoje własne posty czy też nie',

	'POSTLOVE_CLEAN_LOVES'	=> 'Wyczyść wszystkie polubienia postów',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'Jeżeli zainstalowałeś rozszerzenie Post Love przed automatycznym postowaniem i czyszczeniem polubień użytkowników - użyj powyższej opcji, aby wyczyścić niepotrzebne polubienia postów.',
	'CLEAN'	=> 'WYCZYŚĆ',

	//Version 2.0
	'POSTLOVE_HOWMANY_MOST_LIKED_DAY'     => 'How many liked-today posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_WEEK'	=> 'How many liked-this-week posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_MONTH'	=> 'How many liked-this-month posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_YEAR'    => 'How many liked-this-year posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_EVER'	=> 'How many liked-ever posts to show',
	'POSTLOVE_FORUM'	=> 'How many to show on Forum pages',
	'POSTLOVE_INDEX'	=> 'How many to show on Index page',
	'POSTLOVE_SHOW_BUTTON'	=> 'Show the Post like count in a Post Button?',
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'	=> 'The Post like count status and action link may be shown as a Post Button at the top of the post or in the old format at the bottom of the post',
));
