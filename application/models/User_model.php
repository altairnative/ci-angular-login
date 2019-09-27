<?php

class User_model extends CI_Model
{
	const TABLE = 'users';

	public function create(array $data)
	{
		$data = array_merge($data, array('created_at' => date('Y-m-d H:i:s')));
		$this->db->insert(self::TABLE, $data);

		return $this->find($this->db->insert_id());
	}

	public function find(int $id)
	{
		return $this->db
			->from(self::TABLE)
			->where('id', $id)
			->get()
			->row();
	}
}
