<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Lucifer <https://www.anavaro.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\postlove\tests\controller;

/**
* @group controller
*/

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';

class controller_test extends \phpbb_database_test_case
{
	/**
	* Define the extensions to be tested
	*
	* @return array vendor/name of extension(s) to test
	*/
	static protected function setup_extensions()
	{
		return array('anavaro/postlove');
	}
	
	protected $db;
	/**
	* Get data set fixtures
	*/
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/users.xml');
	}
	/**
	* Setup test environment
	*/
	public function setUp()
	{
		parent::setUp();
		$this->db = $this->new_dbal();
	}
	public function test_install()
	{
		$db_tools = new \phpbb\db\tools($this->db);
		$this->assertTrue($db_tools->sql_table_exists('phpbb_posts_likes'));
	}
}