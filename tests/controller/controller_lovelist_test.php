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
require_once dirname(__FILE__) . '/../../../../../includes/functions_content.php';

class controller_lovelist_test extends \phpbb_database_test_case
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

	/**
	* Create our controller
	*/
	protected function get_controller($user_id, $is_registered, $expected, $perm_ary)
	{
		global $phpbb_dispatcher;

		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		
		$this->user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$this->user->data['user_id'] = $user_id;
		$this->user->data['is_registered'] = $is_registered;
		$this->user->lang = array(
			'LIKE_LINE'	=> '%1$s - %2$s <b>liked</b> %3$s\'s post "%4$s" in topic "%5$s"'
		);

		$this->controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function ($template_file, $page_title = '', $status_code = 200, $display_online_list = false) {
				return new \Symfony\Component\HttpFoundation\Response($template_file, $status_code);
			});
		$this->db = $this->new_dbal();

		$this->auth = $this->getMock('\phpbb\auth\auth');
		$this->auth->expects($this->any())
			->method('acl_getf')
			->with($this->stringContains('_'), $this->anything())
			->will($this->returnValue($perm_ary));

		$this->user_loader = new \phpbb\user_loader($this->db, $phpbb_root_path, $phpEx, 'phpbb_users');
		// Mock the template
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->template->expects($this->exactly($expected))
			->method('assign_block_vars');
		
		$this->pagination = $this->getMockBuilder('\phpbb\pagination')->disableOriginalConstructor()
			->getMock();

		$this->request = $this->getMock('\phpbb\request\request');
		
		$controller = new \anavaro\postlove\controller\lovelist(
			$this->user,
			$this->controller_helper,
			$this->db,
			$this->auth,
			$this->user_loader,
			$this->template,
			$this->pagination,
			$this->request,
			'phpbb_',
			'./'
		);
		
		return $controller;
	}

	public function controller_data()
	{
		return array(
			'normal' => array(
				1, // User Id
				true, // Is user registered
				1, // Request Id
				6, // Expected
				array(
					1 => array(
						'f_read'	=> true,
					),
					2 => array(
						'f_read'	=> true,
					),
					3 => array(
						'f_read'	=> true,
					),
				)
			),
			'test_forum' => array(
				2, // User Id
				true, // Is user registered
				1, // Request Id
				5, // Expected
				array(
					1 => array(
						'f_read'	=> true,
					),
					2 => array(
						'f_read'	=> true,
					),
					3 => array(
						'f_read'	=> false,
					),
				)
			),
			'test2' => array(
				1, // User Id
				true, // Is user registered
				3, // Requestor Id
				1, // Expected
				array(
					1 => array(
						'f_read'	=> true,
					),
					2 => array(
						'f_read'	=> false,
					),
					3 => array(
						'f_read'	=> false,
					),
				)
			),
		);
	}

	/**
	 * Test the controller
	 *
	 * @dataProvider controller_data
	 */
	public function test_controller($user_id, $is_registered, $requester_id, $expected, $perm_ary)
	{
		$controller = $this->get_controller($user_id, $is_registered, $expected, $perm_ary);
		$response = $controller->base($requester_id, false);
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals('200', $response->getStatusCode());
	}
}
