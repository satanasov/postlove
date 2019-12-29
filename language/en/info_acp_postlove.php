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
	'POSTLOVE_CONTROL'				=> 'Post like',
	'POSTLOVE_SHOW_LIKES'			=> 'Show number of posts this user has liked',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Show in  <code>viewtopic</code> the number of posts the user has liked.',
	'POSTLOVE_SHOW_LIKED'			=> 'Show the number of liked user\'s posts',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Show in <code>viewtopic</code> how many of the user\'s posts have been liked by others.',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'		=> 'Post love',
	'POSTLOVE_EXPLAIN'	=> 'From here you can change some Post Love settings',
	'CONFIRM_MESSAGE'	=> 'Changes saved!<br><br><a href="%1$s">Back</а>',

	'POSTLOVE_AUTHOR_LIKE'			=> 'Author can like posts',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'Can the author like his/her own posts or not',

	'POSTLOVE_CLEAN_LOVES'			=> 'Clean post loves',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'If you have installed Post Love before automatic post and user love cleaning - please press Clean to clean the unneeded Post Loves',
	'CLEAN'	=> 'Clean',

	//Version 2.0
	'POSTLOVE_SUMMARY_PERIOD'			=> 'Summary Period',
	'POSTLOVE_HOWMANY_MOST_LIKED_DAY'	=> 'How many liked-today posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_WEEK'	=> 'How many liked-this-week posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_MONTH'	=> 'How many liked-this-month posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_YEAR'	=> 'How many liked-this-year posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_EVER'	=> 'How many liked-ever posts to show',
	'POSTLOVE_FORUM'					=> 'How many to show on Forum pages',
	'POSTLOVE_INDEX'					=> 'How many to show on Index page',
	'POSTLOVE_SHOW_BUTTON'				=> 'Show the Post like count in a Post Button?',
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'		=> 'The Post like count status and action link may be shown as a Post Button at the top of the post or in the old format at the bottom of the post',

	'POSTLOVE_IMPORT_THANKS'			=> 'Thanks records able to be imported',
	'POSTLOVE_IMPORT_THANKS_EXPLAIN'	=> 'Thanks records can be imported from the Thanks for Posts extension, this operation does not change the data of the other extension',
	'POSTLOVE_IMPORT_NO_THANKS_EXPLAIN'	=> 'Thanks records can be imported from the Thanks for Posts extension but no suitable records found',
	'IMPORT'							=> 'Import',
));
