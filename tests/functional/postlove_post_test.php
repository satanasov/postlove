<?php
/**
*
* Postlove Control test
*
* @copyright (c) 2014 Stanislav Atanasov
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\postlove\tests\functional;

/**
* @group functional
*/
class postlove_post_test extends postlove_base
{
	protected $post2 = array();
	public function test_post()
	{
		include('parser.php');
		$parser = new CssParser();
		$parser->load_file('../../styles/all/theme/default.css');
		$parser->parse();
		var_dump($parser->css);
		$this->login();
		
		// Test creating topic and post to test
		$post = $this->create_topic(2, 'Test Topic 1', 'This is a test topic posted by the testing framework.');
		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		
		$post2 = $this->create_post(2, $post['topic_id'], 'Re: Test Topic 1', 'This is a test [b]post[/b] posted by the testing framework.');
		$crawler = self::request('GET', "viewtopic.php?t={$post2['topic_id']}&sid={$this->sid}");
		
		//Do we see the static?
		$this->assertContains('0 x', $crawler->filter('#p' . $post2['post_id'])->filter('.postlove')->text());
		
		//toggle like
		$url = $crawler->filter('#p' . $post2['post_id'])->filter('.postlove')->filter('a')->attr('href');
		$crw1 = self::request('GET', substr($url, 1), array(), array(), array('CONTENT_TYPE'	=> 'application/json'));
		
		//reload page and test ...
		$crawler = self::request('GET', "viewtopic.php?t={$post2['topic_id']}&sid={$this->sid}");
		$this->assertContains('1 x', $crawler->filter('#p' . $post2['post_id'])->filter('.postlove')->filter('span')->attr('class'));
		
		$this->logout();
	}
	
	public function test_guest_see_loves()
	{
		$crawler = self::request('GET', "viewtopic.php?t=2&sid={$this->sid}");
		$this->assertContains('1 x', $crawler->filter('#p3')->filter('.postlove')->text());
	}
	
	public function test_guests_cannot_like()
	{
		$crw1 = self::request('GET', 'app.php/postlove/toggle/3', array(), array(), array('CONTENT_TYPE'	=> 'application/json'));
		
		$crawler = self::request('GET', "viewtopic.php?t=2&sid={$this->sid}");
		$this->assertContains('1 x', $crawler->filter('#p3')->filter('.postlove')->text());
		
	}
}
