<?php

/**
*
* newspage [Spanish]
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
	'POSTLOVE_USER_LIKES'	=> 'Al usuario le han gustado',
	'POSTLOVE_USER_LIKED'	=> 'El usuario ha gustado',

	'NOTIFICATION_POSTLOVE_ADD'	=> '%1$s le ha gustado su mensaje "%2$s"',
));
