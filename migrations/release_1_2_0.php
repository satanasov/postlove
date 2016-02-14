<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2016 v12mike <mailto://phpbb@ingenious.co.nz>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace anavaro\postlove\migrations;

/**
* Primary migration
*/

class release_1_2_0 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\anavaro\postlove\migrations\release_1_1_0',
		);
	}

	public function update_data()
	{
		return array(
			array('config.add', array('postlove_index_most_liked_today', 0)),
			array('config.add', array('postlove_index_most_liked_this_week', 0)),
			array('config.add', array('postlove_index_most_liked_this_month', 0)),
			array('config.add', array('postlove_index_most_liked_this_year', 0)),
			array('config.add', array('postlove_index_most_liked_ever', 1)),
			array('config.add', array('postlove_forum_most_liked_today', 0)),
			array('config.add', array('postlove_forum_most_liked_this_week', 0)),
			array('config.add', array('postlove_forum_most_liked_this_month', 0)),
			array('config.add', array('postlove_forum_most_liked_this_year', 0)),
			array('config.add', array('postlove_forum_most_liked_ever', 1)),
			array('config.add', array('postlove_summary_query_cache_seconds', 60)),
		);
	}


	public function revert_data()
	{
		return array(
			array('config.remove', array('postlove_index_most_liked_today')),
			array('config.remove', array('postlove_index_most_liked_this_week')),
			array('config.remove', array('postlove_index_most_liked_this_month')),
			array('config.remove', array('postlove_index_most_liked_this_year')),
			array('config.remove', array('postlove_index_most_liked_ever')),
			array('config.remove', array('postlove_forum_most_liked_today')),
			array('config.remove', array('postlove_forum_most_liked_this_week')),
			array('config.remove', array('postlove_forum_most_liked_this_month')),
			array('config.remove', array('postlove_forum_most_liked_this_year')),
			array('config.remove', array('postlove_forum_most_liked_ever')),
			array('config.remove', array('postlove_summary_query_cache_seconds')),
		);
	}


	// create an index on post_like timestamp
	public function update_schema()
	{
		return array(
			'add_index' => array(
				$this->table_prefix . 'posts_likes' => array(
					'timestamp' => array(
						'timestamp'
					),
				),
			),
		);
	}
}

