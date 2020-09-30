<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oprasional_m extends CI_Model
{
	public function get()
	{
		$this->db->select('*');
		$this->db->from('biaya_pengurusan');
		$post = $this->db->get();
		return $post;
	}

	public function add($post)
	{
		$params['invoice']			= $post['invoice'];
		$params['fee_oprasional']   = str_replace(".", "", $post['fee_oprasional']);
		$params['oprasional']    	= str_replace(".", "", $post['oprasional']);
		$params['pajak_tax']     	= str_replace(".", "", $post['fee_oprasional']);
		$params['lab']     			= str_replace(".", "", $post['lab']);
		$params['jasa_perushaan']   = str_replace(".", "", $post['jasa_perushaan']);
		$params['date']				= $post['date'];
		$params['user_id'] 			= $this->session->userdata('user_id');

		$this->db->insert('biaya_pengurusan', $params);
	}

	public function edit_status($post)
	{
		$params['pembayaran_oprasional'] = 1;

		$this->db->where('invoice', $post['invoice']);
		$this->db->update('pembayaran', $params);
	}
}
