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
	'POSTLOVE_SUMMARY_PERIOD'			=> 'Okres podsumowania',
	'POSTLOVE_HOWMANY_MOST_LIKED_DAY'	=> 'Ile wyświetlać postów polubionych dzisiaj',
	'POSTLOVE_HOWMANY_MOST_LIKED_WEEK'	=> 'Ile wyświetlać postów polubionych w tym tygodniu',
	'POSTLOVE_HOWMANY_MOST_LIKED_MONTH'	=> 'Ile wyświetlać postów polubionych w tym miesiącu',
	'POSTLOVE_HOWMANY_MOST_LIKED_YEAR'	=> 'Ile wyświetlać postów polubionych w tym roku',
	'POSTLOVE_HOWMANY_MOST_LIKED_EVER'	=> 'Ile wyświetlać postów polubionych ogółem',
	'POSTLOVE_FORUM'		=> 'Ile wyświetlać na forum',
	'POSTLOVE_INDEX'		=> 'Ile wyświetlać na stronie głównej',
	'POSTLOVE_SHOW_BUTTON'	=> 'Wyświetlać liczbę polubień na przycisku posta?',
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'	=> 'Status liczby polubień i link akcji mogą się wyświetlać w formie przycisku nad postem, bądź pod postem zgodnie ze starym formatem.',
));
