<?php
/**
*
* Post Love [Czech]
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
	'POSTLOVE_CONTROL'	=> 'Oblíbené příspěvky',
	'POSTLOVE_SHOW_LIKES'	=> 'Zobrazovat počet příspěvků, které se líbí tomuto uživateli.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Zobrazovat ve <code>viewtopic</code> počet příspěvků, které se uživateli líbí.',
	'POSTLOVE_SHOW_LIKED'	=> 'Zobrazovat počet příspěvků, které se líbí ostatním uživatelům.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Zobrazovat ve <code>viewtopic</code> počet příspěvků, které se uživatelům líbily.',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'	=> 'Post love',
	'POSTLOVE_EXPLAIN'	=> 'Zde je možné přizpůsobit nastavení Post Love',
	'CONFIRM_MESSAGE'	=> 'Změny uloženy!<br><br><a href="%1$s">Zpět</а>',

	'POSTLOVE_AUTHOR_LIKE'	=> 'Autor může označovat své vlastní příspěvky',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Je-li povoleno, autor může označit své vlastní příspěvky tlačítkem Líbí se.',

	'POSTLOVE_CLEAN_LOVES'	=> 'Pročistit hodnocení',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'Pokud bylo rozšíření Post Love nainstalováno ještě před uvedením funkce automatického čištění příspěvků a uživatelského Post Love hodnocení, proveďte stiskem tlačítka „Vyčistit“ pročištění nepotřebných Post Love hodnocení.',
	'CLEAN'	=> 'Vyčistit',

	//Version 2.0
	'POSTLOVE_SUMMARY_PERIOD'			=> 'Summary Period',
	'POSTLOVE_HOWMANY_MOST_LIKED_DAY'	=> 'How many liked-today posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_WEEK'	=> 'How many liked-this-week posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_MONTH'	=> 'How many liked-this-month posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_YEAR'	=> 'How many liked-this-year posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_EVER'	=> 'How many liked-ever posts to show',
	'POSTLOVE_FORUM'	=> 'How many to show on Forum pages',
	'POSTLOVE_INDEX'	=> 'How many to show on Index page',
	'POSTLOVE_SHOW_BUTTON'	=> 'Show the Post like count in a Post Button?',
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'	=>'The Post like count status and action link may be shown as a Post Button at the top of the post or in the old format at the bottom of the post',

	'POSTLOVE_IMPORT_THANKS'			=> 'Thanks records able to be imported',
	'POSTLOVE_IMPORT_THANKS_EXPLAIN'	=> 'Thanks records can be imported from the Thanks for Posts extension, this operation does not change the data of the other extension',
	'POSTLOVE_IMPORT_NO_THANKS_EXPLAIN'	=> 'Thanks records can be imported from the Thanks for Posts extension but no suitable records found',
	'IMPORT'							=> 'Import',
));
