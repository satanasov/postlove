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
	'POSTLOVE_USER_LIKES'	=> 'Потребителя е харесал',
	'POSTLOVE_USER_LIKED'	=> 'Потребителя е харесан',
	
	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s хареса вашето мнение "%2$s"',
));
