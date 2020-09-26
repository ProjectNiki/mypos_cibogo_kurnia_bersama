<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");
class Customers_m extends CI_Model
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
