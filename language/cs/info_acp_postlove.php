<?php
/**
*
* newspage [Czech]
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
	'POSTLOVE_CONTROL'	=> 'Oblíbené příspěvky',
	'POSTLOVE_USE_CSS'	=> 'Používat CSS z rozšíření',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Pro snadnější přizpůsobení rozšíření můžete zakázat načítání CSS stylů, které jsou jeho součástí a navrhnout si svůj vlastní styl. Pokud chcete používat vlastní obrázky, zaměřte se na <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Zobrazovat počet příspěvků, které se líbí tomuto uživateli.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Zobrazovat ve <code>viewtopic</code> počet příspěvků, které se uživateli líbí.',
	'POSTLOVE_SHOW_LIKED'	=> 'Zobrazovat počet příspěvků, které se líbí ostatním uživatelům.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Zobrazovat ve <code>viewtopic</code> počet příspěvků, které se uživatelům líbily.',
));
