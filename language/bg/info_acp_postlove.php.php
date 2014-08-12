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
	'POSTLOVE_CONTROL'	=> 'Харесване на постове',
	'POSTLOVE_USE_CSS'	=> 'Използвай CSS на разширението',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'За по-лесна промяна на стила на разширението за харесване на постове можете да спрете показването на CSS-а по подразбиране. Ако искате да използвате свои каритники моля погледнете <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Покажи броя на харесаните от потребителя постове',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Покажи в <code>viewtopic</code> общия брой на харесаните от този потребител постове.',
	'POSTLOVE_SHOW_LIKED'	=> 'Покажи броя на харесаните постове на потребителя',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Покажи в <code>viewtopic</code> общия брой на харесаните постове на този потребител.',
));
