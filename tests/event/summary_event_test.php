<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2018 v12mike
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\postlove\tests\summaryevent;

/**
* @group event
*/

class summary_event extends \phpbb_database_test_case
{
	protected $listener;

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
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/summary_data.xml');
	}

	/**
	* Setup test environment
	*/
	public function setUp()
	{
		global $phpbb_dispatcher, $user, $config, $auth, $cache;

		parent::setUp();
		// Setup Auth
		$this->auth = $this->getMock('\phpbb\auth\auth');
		$auth = $this->auth;

		//Setup Config
		$this->config = new \phpbb\config\config(array());
		$config = $this->config;

		// Setup DB
		$this->db = $this->new_dbal();

		//Setup Cache
		$this->cache = new \phpbb\cache\service(new \phpbb\cache\driver\dummy(), $this->config, $this->db, $phpbb_root_path, $phpEx);
		$cache = $this->cache;

		$this->dispatcher = new \phpbb_mock_event_dispatcher();
		$phpbb_dispatcher = $this->dispatcher;

		// Setup template
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		// Setup User
		$this->user = $this->getMock('\phpbb\user', array(), array(
			new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx)),
			'\phpbb\datetime',
			));
		$this->user->method('format_date')
			->will($this->returnArgument(0));
		$user = $this->user;

		$this->content_visibility = new \phpbb\content_visibility($this->auth, $this->config, $this->dispatcher, $this->db, $this->user, $phpbb_root_path, $phpEx, FORUMS_TABLE, POSTS_TABLE, TOPICS_TABLE, USERS_TABLE);

		$this->language = $this->getMockBuilder('\phpbb\language\language')
			->disableOriginalConstructor()
			->getMock();
		$this->language->method('lang')
			->will($this->returnArgument(0));
	}

	/**
	* Create our listener
	*/
	protected function set_listener()
	{
		$this->listener = new \anavaro\postlove\event\summary_listener(
			$this->auth,
			$this->config,
			$this->cache,
			$this->content_visibility,
			$this->db,
			$this->dispatcher,
			$this->template,
			$this->user,
			$this->language,
			'/',
			'.php',
			'phpbb_',
			1500000000 // test timestamp
		);
	}

	/**
	* Test the event listener is subscribing events
	*/
	public function test_getSubscribedEvents()
	{
		$this->assertEquals(array(
			'core.index_modify_page_title',
			'core.viewforum_modify_page_title',
		), array_keys(\anavaro\postlove\event\summary_listener::getSubscribedEvents()));
	}

	/**
	* data provider for test_index_modify_page_title
	*/
	public function data_index_modify_page_title()
	{
		return array(
			'show all' => array(
				2, // user_id
				10, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
						2 => array('f_read' => 1), // can view forum 2
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 5,
				),
				5, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=4#p4',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '4000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 2,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=2&amp;t=2&amp;p=2#p2',
						'U_FORUM'   		=> '/viewforum..php?f=2',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '2000',
						'TOPIC_TITLE'   	=> 'test 2',
						'FORUM_NAME'		=> 'Forum 2',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'show all only in Forum 1' => array(
				2, // user_id
				10, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 4,
				),
				4, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=4#p4',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '4000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 2,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'anonymous user' => array(
				1, // user_id
				1, // postlove_liked_ever
				1, // postlove_liked_this_year
				1, // postlove_liked_this_month
				1, // postlove_liked_this_week
				1, // postlove_liked_today
				array(
					1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 3,
					),
				3, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=3" style="color: #blue;" class="username-coloured">Test user 3</a>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 2,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=3" style="color: #blue;" class="username-coloured">Test user 3</a>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=3" style="color: #blue;" class="username-coloured">Test user 3</a>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_MONTH',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only this year' => array(
				2, // user_id
				0, // postlove_liked_ever
				10, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 3,
				),
				3, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only this month' => array(
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				10, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 2,
				),
				2, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_MONTH',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_MONTH',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only this week' => array(
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				10, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 2,
				),
				2, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_WEEK',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_WEEK',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only today' => array(
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				10, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 1,
				),
				1, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_TODAY',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_TODAY',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'none at all' => array(
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
						2 => array('f_read' => 1), // can view forum 2
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 0,
				),
				0, // count
				array(),
				),
			);
	}

	/**
	* Let's test index_modify_page_title
	* @dataProvider data_index_modify_page_title
	*/
	public function test_index_modify_page_title($user_id,
												 $postlove_liked_ever,
												 $postlove_liked_this_year,
												 $postlove_liked_this_month,
												 $postlove_liked_this_week,
												 $postlove_liked_today,
												 $permissions,
												 $expected1,
												 $count,
												 $expected2)
	{
		$this->config['postlove_index_most_liked_ever'] = $postlove_liked_ever;
		$this->config['postlove_index_most_liked_this_year'] = $postlove_liked_this_year;
		$this->config['postlove_index_most_liked_this_month'] = $postlove_liked_this_month;
		$this->config['postlove_index_most_liked_this_week'] = $postlove_liked_this_week;
		$this->config['postlove_index_most_liked_today'] = $postlove_liked_today;
		$this->user->data['user_id'] = $user_id;
		$tmp = $permissions;
		$this->auth->expects($this->any())
			->method('acl_getf')
			->willreturn($permissions);

		$event_data = array();
		$event = new \phpbb\event\data(compact($event_data));
		$this->set_listener();
		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.index_modify_page_title', array($this->listener, 'index_page_summary'));
		$this->template->expects($this->once())
			->method('assign_vars')
			->with($expected1);
		$this->template->expects($this->exactly($count))->method('assign_block_vars');
		for ($i = 0; $i < $count; $i++) {
			$this->template->expects($this->at($i))
				->method('assign_block_vars')
				->with('most_liked_posts', $expected2[$i]);
		}

		$dispatcher->dispatch('core.index_modify_page_title', $event);
	}

	/**
	* data provider for test_viewforum_modify_page_title
	*/
	public function data_viewforum_modify_page_title()
	{
		return array(
			'show all' => array(
				1, //forum_id
				2, // user_id
				10, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
						2 => array('f_read' => 1), // can view forum 2
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 5,
				),
				5, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=4#p4',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '4000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 2,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=2&amp;t=2&amp;p=2#p2',
						'U_FORUM'   		=> '/viewforum..php?f=2',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '2000',
						'TOPIC_TITLE'   	=> 'test 2',
						'FORUM_NAME'		=> 'Forum 2',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'show all only in Forum 1' => array(
				1, //forum_id
				2, // user_id
				10, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 4,
				),
				4, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=4#p4',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '4000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 2,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'anonymous user' => array(
				1, //forum_id
				1, // user_id
				1, // postlove_liked_ever
				1, // postlove_liked_this_year
				1, // postlove_liked_this_month
				1, // postlove_liked_this_week
				1, // postlove_liked_today
				array(
					1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 3,
					),
				3, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=3" style="color: #blue;" class="username-coloured">Test user 3</a>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_EVER',
						'LIKES_IN_PERIOD'   => 2,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=3" style="color: #blue;" class="username-coloured">Test user 3</a>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<a href="phpBB/memberlist.php?mode=viewprofile&amp;u=3" style="color: #blue;" class="username-coloured">Test user 3</a>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_MONTH',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only this year' => array(
				1, //forum_id
				2, // user_id
				0, // postlove_liked_ever
				10, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 3,
				),
				3, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=3&amp;p=5#p5',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '5000',
						'TOPIC_TITLE'   	=> 'test 3',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_YEAR',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only this month' => array(
				1, //forum_id
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				10, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 2,
				),
				2, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_MONTH',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_MONTH',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only this week' => array(
				1, //forum_id
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				10, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 2,
				),
				2, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_WEEK',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_THIS_WEEK',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'only today' => array(
				1, //forum_id
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				10, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 1,
				),
				1, // count
				array(
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=1#p1',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '1000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_TODAY',
						'LIKES_IN_PERIOD'   => 1,
						),
					array(
						'U_TOPIC'   		=> '/viewtopic..php?f=1&amp;t=1&amp;p=3#p3',
						'U_FORUM'   		=> '/viewforum..php?f=1',
						'S_UNREAD'  		=> false,
						'USERNAME_FULL' 	=> '<span style="color: #blue;" class="username-coloured">Test user 3</span>',
						'POST_TIME' 		=> '3000',
						'TOPIC_TITLE'   	=> 'test 1',
						'FORUM_NAME'		=> 'Forum 1',
						'POST_LIKES_IN_PERIOD'  => 'LIKES_TODAY',
						'LIKES_IN_PERIOD'   => 1,
						),
					),
				),
			'none at all' => array(
				1, //forum_id
				2, // user_id
				0, // postlove_liked_ever
				0, // postlove_liked_this_year
				0, // postlove_liked_this_month
				0, // postlove_liked_this_week
				0, // postlove_liked_today
				array(
						1 => array('f_read' => 1), // can view forum 1
						2 => array('f_read' => 1), // can view forum 2
					), // user permissions
				array(
					'S_MOSTLIKEDSUMMARYCOUNT'	=> 0,
				),
				0, // count
				array(),
				),
			);
	}

	/**
	* Let's test viewforum_modify_page_title
	* @dataProvider data_viewforum_modify_page_title
	*/
	public function test_viewforum_modify_page_title($forum_id,
													 $user_id,
													 $postlove_liked_ever,
													 $postlove_liked_this_year,
													 $postlove_liked_this_month,
													 $postlove_liked_this_week,
													 $postlove_liked_today,
													 $permissions,
													 $expected1,
													 $count,
													 $expected2)
	{
		$this->config['postlove_forum_most_liked_ever'] = $postlove_liked_ever;
		$this->config['postlove_forum_most_liked_this_year'] = $postlove_liked_this_year;
		$this->config['postlove_forum_most_liked_this_month'] = $postlove_liked_this_month;
		$this->config['postlove_forum_most_liked_this_week'] = $postlove_liked_this_week;
		$this->config['postlove_forum_most_liked_today'] = $postlove_liked_today;
		$this->user->data['user_id'] = $user_id;
		$tmp = $permissions;
		$this->auth->expects($this->any())
			->method('acl_getf')
			->willreturn($permissions);

		$row = array(
			'forum_id' => $forum_id,
		);
		$event_data = array('forum_id');
		$event = new \phpbb\event\data(compact($event_data));
		$this->set_listener();
		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.viewforum_modify_page_title', array($this->listener, 'forum_page_summary'));
		$this->template->expects($this->once())
			->method('assign_vars')
			->with($expected1);
		$this->template->expects($this->exactly($count))->method('assign_block_vars');
		for ($i = 0; $i < $count; $i++) {
			$this->template->expects($this->at($i))
				->method('assign_block_vars')
				->with('most_liked_posts', $expected2[$i]);
		}

		$dispatcher->dispatch('core.viewforum_modify_page_title', $event);
	}
}

