<?php

/**
*
* newspage [Dutch]
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
	'POSTLOVE_CONTROL'	=> 'Post "vind ik leuk"',
	'POSTLOVE_USE_CSS'	=> 'Gebruik bijgeleverde CSS',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Om POST LOVE makkelijker te kunnen aanpassen kan je het laden van de standaard CSS uitzetten. Als je je eigen afbeeldingen wil gebruiken, kijk dan in <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Laat het aantal posts zien die deze gebruiker leuk vindt',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Laat het aantal posts dat een gebruiker leuk vind zien in <code>viewtopic</code>',
	'POSTLOVE_SHOW_LIKED'	=> 'Laat het aantal door anderen leuk gevonden posts van de gebruiker zien',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Laat in <code>viewtopic</code> zien hoeveel posts van deze gebruiker leuk gevonden worden door anderen',
));
