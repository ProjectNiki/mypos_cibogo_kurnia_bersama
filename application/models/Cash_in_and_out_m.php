<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");
class Cash_in_and_out_m extends CI_Model
{
	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('cash_in_cash_out');

		if ($id != null) {
			$this->db->where('cico_id', $id);
		}

		$post = $this->db->get();
		return $post;
	}

	public function add_in($post)
	{
		$params['date']			= $post['date'];
		$params['type'] 		= $post['type_in'];
		$params['pj'] 			= $post['nama'];
		$params['payment']		= $post['payment_in'];
		$params['total']      	= str_replace(".", "", $post['total_in']);
		$params['noted']	 	= $post['noted'];
		$params['user_id']		= $this->session->userdata('user_id');

		$this->db->insert('cash_in_cash_out', $params);
	}

	public function add_out($post)
	{
		$params['date']			= $post['date'];
		$params['type'] 		= $post['type_out'];
		$params['pj'] 			= $post['pic'];
		$params['payment']		= $post['payment_out'];
		$params['total']      	= str_replace(".", "", $post['total_out']);
		$params['noted']	 	= $post['noted'];
		$params['user_id']		= $this->session->userdata('user_id');

		$this->db->insert('cash_in_cash_out', $params);
	}


	public function edit_in($post)
	{
		$params['date']			= $post['date'];
		$params['type'] 		= $post['type_in'];
		$params['pj'] 			= $post['nama'];
		$params['payment']		= $post['payment_in'];
		$params['total']      	= str_replace(".", "", $post['total_in']);
		$params['noted']	 	= $post['noted'];
		$params['updated']      = date('Y-m-d H:i:s');

		$this->db->where('cico_id', $post['cico_id']);
		$this->db->update('cash_in_cash_out', $params);
	}

	public function edit_out($post)
	{
		$params['date']			= $post['date'];
		$params['type'] 		= $post['type_out'];
		$params['pj'] 			= $post['pic'];
		$params['payment']		= $post['payment_out'];
		$params['total']      	= str_replace(".", "", $post['total_out']);
		$params['noted']	 	= $post['noted'];
		$params['updated']      = date('Y-m-d H:i:s');

		$this->db->where('cico_id', $post['cico_id']);
		$this->db->update('cash_in_cash_out', $params);
	}


	public function del($id)
	{
		$this->db->where('cico_id', $id);
		$this->db->delete('cash_in_cash_out');
	}
}
