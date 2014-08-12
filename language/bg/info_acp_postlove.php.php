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
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'За по-лесна промяна на стила на разширението за харесване на постове можете да спрете показването на CSS-а по подразбиране. Ако искате да използвате свои каритники моля погледнете <code>overall_header_head_append.html</code>'
));