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
class release_2_0_0 extends \phpbb\db\migration\profilefield_base_migration
{
	static public function depends_on()
	{
		return array(
			'\anavaro\postlove\migrations\release_2_0_0_prep',
		);
	}


	public function update_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'posts_likes'	=> array(
					'timestamp' => array('TIMESTAMP', 0 ),
				),
			),
			'add_index' => array(
				$this->table_prefix . 'posts_likes' => array(
					'timestamp' => array(
						'timestamp',
					),
				),
			),
			'drop_columns' => array(
				$this->table_prefix . 'posts_likes'	=> array(
					'temp_timestamp',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'add_columns' => array(
				$this->table_prefix . 'posts_likes'	=> array(
					'temp_timestamp' => array('TIMESTAMP', 0),
				),
			),
			'drop_columns' => array(
				$this->table_prefix . 'posts_likes'	=> array(
					'timestamp',
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			array('custom', array(
				array($this, 'convert_temp_timestamp')
				)),
			);
	}

	public function revert_data()
	{
		return array(
			array('custom', array(
				array($this, 'revert_timestamp')
				)),
			);
	}


	public function convert_temp_timestamp($start)
	{
		$start = (int) $start;
		$limit = 100;
		$rows_done = 0;

		$sql = 'SELECT * FROM ' . $this->table_prefix . 'posts_likes';
		$result = $this->db->sql_query_limit($sql, $limit, $start);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$rows_done++;

			$sql = 'UPDATE ' . $this->table_prefix . 'posts_likes AS pl
				SET timestamp = ' . $row['temp_timestamp'] . '
				WHERE pl.post_id = ' . $row['post_id'] . ' AND pl.user_id = ' . $row['user_id'];
		}
		$this->db->sql_freeresult($result);

		if ($rows_done < $limit)
		{
			// There are no more, we are done
			return;
		}

		// There are still more to query, return the next start value
		return $start + $limit;
	}

	public function revert_timestamp($start)
	{
		$start = (int) $start;
		$limit = 100;
		$rows_done = 0;

		$sql = 'SELECT * FROM ' . $this->table_prefix . 'posts_likes';
		$result = $this->db->sql_query_limit($sql, $limit, $start);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$rows_done++;

			$sql = 'UPDATE ' . $this->table_prefix . 'posts_likes AS pl
				SET temp_timestamp = ' . $row['timestamp'] . '
				WHERE pl.post_id = ' . $row['post_id'] . ' AND pl.user_id = ' . $row['user_id'];
		}
		$this->db->sql_freeresult($result);

		if ($rows_done < $limit)
		{
			// There are no more, we are done
			return;
		}

		// There are still more to query, return the next start value
		return $start + $limit;
	}
}

