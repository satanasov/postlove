<?php

/**
*
* newspage [Bulgarian]
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
	'POSTLOVE_CONTROL'	=> 'Post like',
	'POSTLOVE_USE_CSS'	=> 'Use provided CSS',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'For easear customisation of the POST LOVE extension you could stop it from loading the default CSS. If you want to use your own images, please refer to <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Show number of posts this user has liked.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Show in  <code>viewtopic</code> the number of posts the user have liked.',
	'POSTLOVE_SHOW_LIKED'	=> 'Show the number of liked user\'s posts.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Show in <code>viewtopic</code> how many of the user\'s posts have been liked by others.',
));