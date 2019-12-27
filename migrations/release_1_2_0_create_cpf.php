<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 v12mike
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace anavaro\postlove\migrations;

/**
* Primary migration
*/
class release_1_2_0_create_cpf extends \phpbb\db\migration\profilefield_base_migration
{
	static public function depends_on()
	{
		return array(
			'\anavaro\postlove\migrations\release_1_2_0',
		);
	}
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'create_custom_field'))),
		);
	}
	protected $profilefield_name = 'postlove_hide';
	protected $profilefield_database_type = array('UINT:2');
	protected $profilefield_data = array(
		'field_name'            => 'postlove_hide',
		'field_type'			=> 'profilefields.type.bool',
		'field_ident'           => 'postlove_hide',
		'field_length'          => '2',
		//'field_minlen'		=> 0,
		//'field_maxlen'		=> 0,
		//'field_novalue'		=> 1,
		'field_default_value'	=> 0,
		//'field_validation'	=> '',
		'field_required'		=> 0,
		'field_show_novalue'	=> 0,
		'field_show_on_reg'		=> 0,
		'field_show_on_pm'		=> 0,
		'field_show_on_vt'		=> 0,
		'field_show_profile'	=> 1,
		'field_show_on_ml'		=> 0,
		'field_hide'			=> 0,
		'field_no_view'			=> 1,
		'field_active'			=> 1,
		'field_is_contact'		=> 0,
		'field_contact_desc'	=> '',
		'field_contact_url'		=> '',
	);
}
