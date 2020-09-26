<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_m extends CI_Model
{
	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('user');
		if ($id != NULL) {
			$this->db->where('user_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
