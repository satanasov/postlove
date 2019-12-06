<?php

/**
*
* Post Love [English]
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
	'POSTLOVE_CONTROL'	=> 'Beitrag gefällt mir',
	'POSTLOVE_SHOW_LIKES'	=> 'Zeige die Anzahl an Beiträge, die dem Benutzer gefallen.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Zeige die Anzahl an Beiträge in  <code>viewtopic</code> die Anzahl an Beiträge, die dem Benutzer gefallen.',
	'POSTLOVE_SHOW_LIKED'	=> 'Zeige die Anzahl an Beiträgen des User\'s die Anderen gefallen haben.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Zeige in <code>viewtopic</code> die Anzahl an Beiträgen des User\'s die Anderen gefallen haben.',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'	=> 'Post love',
	'POSTLOVE_EXPLAIN'	=> 'Hier kann man die Post Love Einstellungen ändern',
	'CONFIRM_MESSAGE'	=> 'Änderungen gespeichert!<br><br><a href="%1$s">Zurück</а>',

	'POSTLOVE_AUTHOR_LIKE'	=> 'Autor können Beiträge gefallen',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Dürfen dem Autor seine eigenen Beiträge gefallen',

	'POSTLOVE_CLEAN_LOVES'	=> 'Gefällt mir Angaben bereinigen',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'Wenn Du Post Love installiert hast, bervor automatisches Aufräumen aktiviert war - Bitte Reinigen drücken um ungewollte Gefällt-Mir-Angaben zu bereinigen',
	'CLEAN'	=> 'Reinigen',

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
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'	=>'The Post like count status and action link may be shown as a Post Button at the top of the post or in the old format at the bottom of the post',
));

