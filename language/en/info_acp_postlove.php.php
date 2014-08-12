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
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'For easear customisation of the POST LOVE extension you could stop it from loading the default CSS. If you want to use your own images, please refer to <code>overall_header_head_append.html</code>'
));