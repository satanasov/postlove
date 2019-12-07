<?php
/**
*
* Post Love extension for the phpBB Forum Software package.
*
* @copyright (c) 2018 v12mike
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/
namespace anavaro\postlove\migrations;

/**
* Primary migration
*/
class release_2_0_0_add_liked_user_id extends \phpbb\db\migration\profilefield_base_migration
{
	static public function depends_on()
	{
		return array(
			'\anavaro\postlove\migrations\release_2_0_0_drop_timestamp',
		);
	}


	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'posts_likes'	=> array(
					'liked_user_id' => array('UINT:8', 0),
				),
			),
			'add_index' => array(
				$this->table_prefix . 'posts_likes' => array(
					'liked_user_id' => array(
						'liked_user_id',
					),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				$this->table_prefix . 'posts_likes'	=> array(
					'liked_user_id',
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(
				array($this, 'populate_liked_user_id')
				)),
			);
	}

	public function revert_data()
	{
		return array();
	}

	public function populate_liked_user_id($start)
	{
		$start = (int) $start;
		$limit = 100;
		$rows_done = 0;

		$sql = 'SELECT p.poster_id as liked_user_id, pl.post_id as post, pl.user_id as liker
			FROM ' . $this->table_prefix . 'posts_likes pl
			INNER JOIN ' . $this->table_prefix . 'posts p
            ON p.post_id = pl.post_id
			ORDER BY post ASC, liker ASC';
		$result = $this->db->sql_query_limit($sql, $limit, $start);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$sql = 'UPDATE ' . $this->table_prefix . 'posts_likes
				SET liked_user_id = ' . (int) $row['liked_user_id'] . '
				WHERE post_id = ' . (int) $row['post'] . ' AND user_id = ' . (int) $row['liker'] ;
			$this->db->sql_query($sql);
			$rows_done++;
		}
		$this->db->sql_freeresult($result);

		if ($rows_done < $limit)
		{
			// There are no more, we are done
			return;
		}

		// There are still more to query, return the next start value
		return $start += $limit;
	}
}
