<?php

/**
*
* Post Love [Dutch]
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
	'POSTLOVE_CONTROL'	=> 'Post Love',
	'POSTLOVE_USE_CSS'	=> 'Gebruik bijgeleverde CSS:',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Om POST LOVE makkelijker te kunnen aanpassen kan je het laden van de standaard CSS uitzetten. Als je je eigen afbeeldingen wil gebruiken, kijk dan in <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Laat het aantal berichten zien dat deze gebruiker leuk vindt:',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Laat het aantal berichten dat een gebruiker leuk vind zien in <code>viewtopic</code> pagina.',
	'POSTLOVE_SHOW_LIKED'	=> 'Laat het aantal door anderen leuk gevonden berichten van de gebruiker zien:',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Laat in <code>viewtopic</code> zien hoeveel berichten van deze gebruiker leuk gevonden worden door anderen.',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'	=> 'Post Love',
	'POSTLOVE_EXPLAIN'	=> 'Hier kun je instellingen van Post Love veranderen.',
	'CONFIRM_MESSAGE'	=> 'Veranderingen opgeslagen!<br><br><a href="%1$s">Terug</а>',

	'POSTLOVE_AUTHOR_LIKE'	=> 'Auteur kan bericht leuk vinden:',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Kan de auteur zijn/haar eigen berichten leuk vinden (of niet).',

	'POSTLOVE_CLEAN_LOVES'	=> 'Opruimen post loves',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'Als je een oude versie van Post Love gebruikt hebt waar automatisch opschonen nog niet beschikbaar was, druk dan op \'Opruimen\' om de database op te schonen.',
	'CLEAN'	=> 'Opruimen',

	//Version 2.0
	'POSTLOVE_SUMMARY_PERIOD'			=> 'Summary Period',
	'POSTLOVE_HOWMANY_MOST_LIKED_DAY'	=> 'How many liked-today posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_WEEK'	=> 'How many liked-this-week posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_MONTH'	=> 'How many liked-this-month posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_YEAR'	=> 'How many liked-this-year posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_EVER'	=> 'How many liked-ever posts to show',
	'POSTLOVE_FORUM'		=> 'How many to show on Forum pages',
	'POSTLOVE_INDEX'		=> 'How many to show on Index page',
	'POSTLOVE_SHOW_BUTTON'	=> 'Show the Post like count in a Post Button?',
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'	=> 'The Post like count status and action link may be shown as a Post Button at the top of the post or in the old format at the bottom of the post',
));

