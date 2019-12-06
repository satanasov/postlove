<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
* French translation by Galixte (http://www.galixte.com)
*
* @copyright (c) 2015 Stanislav Atanasov <http://anavaro.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'POSTLOVE_CONTROL'	=> '« J’aime » un message',
	'POSTLOVE_SHOW_LIKES'	=> 'Afficher le nombre de « J’aime » exprimés par l’utilisateur',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Permet d’afficher le nombre de messages aimés par l’utilisateur sur les pages des sujets, <code>viewtopic</code>, au moyen du terme : « J’aime ».',
	'POSTLOVE_SHOW_LIKED'	=> 'Afficher le nombre de « J’aime » reçus par les utilisateurs',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Permet d’afficher le nombre de messages aimés des autres utilisateurs sur les pages des sujets, <code>viewtopic</code>, au moyen du terme « J’aime ».',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Aimer un message',
	'ACP_POSTLOVE'	=> 'Aimer un message',
	'POSTLOVE_EXPLAIN'	=> 'Depuis cette page il est possible de modifier les paramètres de l’extension « Post Love ».',
	'CONFIRM_MESSAGE'	=> 'Les modifications ont été sauvegardées !<br><br><a href="%1$s">Retour</а>',

	'POSTLOVE_AUTHOR_LIKE'	=> 'L’auteur peut aimer ses messages',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Permettre ou non à l’auteur d’aimer son/ses propre(s) message(s).',

	'POSTLOVE_CLEAN_LOVES'	=> 'Nettoyer les « J’aime » des messages',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'Permet de nettoyer les « J’aime » inutiles des messages. Cette action est utile si l’extension « Post Love » a été installée avant le nettoyage automatique des messages et des « j’aime » d’utilisateurs.',
	'CLEAN'	=> 'Nettoyer',

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
