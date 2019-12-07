<?php

/**
*
* Post Love [Brazilian Portuguese [pt_br]]
* Brazilian Portuguese translation by eunaumtenhoid (c) 2017 [ver 1.2.1] (https://github.com/phpBBTraducoes)
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
	'POSTLOVE_CONTROL'	=> 'Curtir Post',
	'POSTLOVE_SHOW_LIKES'	=> 'Mostra o número de postagens que este usuário curtiu',
	'POSTLOVE_SHOW_LIKES_EXPLAIN'	=> 'Mostre em <code>viewtopic</code> o número de postagens que o usuário curtiu.',
	'POSTLOVE_SHOW_LIKED'	=> 'Mostra o número de curtidas nas postagens do usuário',
	'POSTLOVE_SHOW_LIKED_EXPLAIN'	=> 'Mostrar em <code>viewtopic</code> quantos posts do usuário foram curtidos por outros.',

	//Version 1.1 langs
	'ACP_POSTLOVE_GRP'	=> 'Post Love',
	'ACP_POSTLOVE'	=> 'Post love',
	'POSTLOVE_EXPLAIN'	=> 'A partir daqui, você pode alterar algumas configurações do Post Love',
	'CONFIRM_MESSAGE'	=> 'Alterações salvas!<br><br><a href="%1$s">Voltar</а>',

	'POSTLOVE_AUTHOR_LIKE'	=> 'O autor pode curtir posts',
	'POSTLOVE_AUTHOR_LIKE_EXPLAIN'	=> 'O autor pode curtir suas próprios posts ou não',

	'POSTLOVE_CLEAN_LOVES'	=> 'Limpar post loves',
	'POSTLOVE_CLEAN_LOVES_EXPLAIN'	=> 'Se você instalou o Post Love antes da postagem automática e usou limpeza love - por favor, pressione Limpar para limpar os Post Loves desnecessários ',
	'CLEAN'	=> 'LIMPAR',

	//Version 2.0
	'POSTLOVE_SUMMARY_PERIOD'			=> 'Summary Period',
	'POSTLOVE_HOWMANY_MOST_LIKED_DAY'	=> 'How many liked-today posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_WEEK'	=> 'How many liked-this-week posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_MONTH'	=> 'How many liked-this-month posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_YEAR'	=> 'How many liked-this-year posts to show',
	'POSTLOVE_HOWMANY_MOST_LIKED_EVER'	=> 'How many liked-ever posts to show',
	'POSTLOVE_FORUM'		=> 'How many to show on Forum pages',
	'POSTLOVE_INDEX'		=> 'How many to show on Index page',
	'POSTLOVE_SHOW_BUTTON'	=> 'Show the Post like count in a Post Button?',
	'POSTLOVE_SHOW_BUTTON_EXPLAIN'	=> 'The Post like count status and action link may be shown as a Post Button at the top of the post or in the old format at the bottom of the post',
));
