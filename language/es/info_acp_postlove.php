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
	'POSTLOVE_CONTROL'	=> 'Mensaje que gusta',
	'POSTLOVE_USE_CSS'	=> 'Usar CSS proporcionado',
	'POSTLOVE_USE_CSS_EXPLAIN'	=> 'Para facilitar la personalización de la extensión POST LOVE, podría usted evitar la carga del CSS por defecto. Si desea utilizar sus propias imágenes, por favor, consulte el archivo <code>overall_header_head_append.html</code>',
	'POSTLOVE_SHOW_LIKES'	=> 'Mostrar el número de mensajes que le han gustado.',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Mostrar en <code>viewtopic</code> el número de mensajes que han gustado a este usuario.',
	'POSTLOVE_SHOW_LIKED'	=> 'Mostrar el número de mensajes que han gustado.',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Mostrar en <code>viewtopic</code> cuántos mensajes del usuario han gustado a los demás.',
));
