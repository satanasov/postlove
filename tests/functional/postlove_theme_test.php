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
class postlove_theme_test extends postlove_base
{
	public function test_choose_silvormike()
	{
		$this->login();
		$this->admin_login();

		$this->add_lang_ext('anavaro/postlove', 'info_acp_postlove');

		$crawler = self::request('GET', 'adm/index.php?i=-anavaro-postlove-acp-acp_postlove_module&mode=main&sid=' . $this->sid);
		$form = $crawler->selectButton('apply')->form();
		$form->setValues(array(
			'poslove_choose'	=> 'silvormike'
		));
		$crawler = self::submit($form);
		$this->assertContainsLang('THEME_CHANGED', $crawler->text());

		// Select theme
		$crawler = self::request('GET', "viewtopic.php?t=2&sid={$this->sid}");
		$this->assertContains('zazaza' , $crawler->text());
	}
}