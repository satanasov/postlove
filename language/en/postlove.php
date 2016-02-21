<?php

/**
*
* newspage [English]
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
	'POSTLOVE_USER_LIKES'	=> 'User likes',
	'POSTLOVE_USER_LIKED'	=> 'User is liked',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s <b>liked</b> your post "%2$s"',
	'NOTIFICATION_TYPE_POST_LOVE'	=> 'Liked posts.',

	// Ver 1.1
	'LIKE_LINE'	=> '%1$s - %2$s <b>liked</b> %3$s\'s post "%4$s" in topic "%5$s"',
	'POSTLOVE_LIST'	=> 'Likes',
	'POSTLOVE_LIST_VIEW'	=> 'Show list with all like actions',

	// Ver 1.2

	'CLICK_TO_LIKE' 	=> 'click to like this post',
	'CLICK_TO_UNLIKE'   => 'click to unlike this post',
	'LOGIN_TO_LIKE_POST' => 'login to like this post',
	'CANT_LIKE_OWN_POST' => 'sorry, you cant like your own post',
	'POST_OF_THE_DAY'	=> 'Most liked posts',
	'LIKED_BY'			=> 'post liked by: ',
	'IN'				=> 'In',
	'BY'				=> 'by:',
	'LIKES_TODAY'   	=> array(
		1	=> 'Liked once today:',
		2	=> 'Liked %d times today:',
	),
	'LIKES_THIS_WEEK'   	=> array(
		1	=> 'Liked once this week',
		2	=> 'Liked %d times this week',
	),
	'LIKES_THIS_MONTH'  	 => array(
		1	=> 'Liked once this month',
		2	=> 'Liked %d times this month',
	),
	'LIKES_THIS_YEAR'   	=> array(
		1	=> 'Liked once this year',
		2	=> 'Liked %d times this year',
	),
	'LIKES_EVER'	   => array(
		1	=> 'Liked once in total',
		2	=> 'Liked %d times in total',
	),
	'POSTLOVE_HIDE' 			=> 'Hide Like icons and summaries',
));
