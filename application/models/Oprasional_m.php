<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Oprasional_m extends CI_Model
{

	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('biaya_pengurusan_detail');
		$this->db->join('user', 'user.user_id = biaya_pengurusan_detail.user_id');
		if ($id != NULL) {
			$this->db->where('bpd_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_cetak($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('biaya_pengurusan_detail');
		$this->db->join('user', 'user.user_id = biaya_pengurusan_detail.user_id');
		if ($id != NULL) {
			$this->db->where('bp_key', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_laporan()
	{
		$this->db->select('*');
		$this->db->from('biaya_pengurusan_detail');
		$this->db->group_by('bp_key');

		$query = $this->db->get();
		return $query;
	}

	public function get_existing()
	{
		$this->db->select('*');
		$this->db->from('biaya_pengurusan_detail');
		$this->db->group_by('bp_key');

		$query = $this->db->get();
		return $query;
	}

	public function ai_code()
	{
		$query = $this->db->query("SELECT MAX(bp_key) as bp_key from biaya_pengurusan_detail");
		$hasil = $query->row();
		return $hasil->bp_key;
	}

	public function get_oprasional()
	{
		$this->db->select('*, pembayaran.created as created_pembelian');
		$this->db->from('pembayaran');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');

		$where = "status=1 OR lunas_down_payment=1";
		$this->db->where($where);

		$this->db->group_by('pembayaran.no_urut_invoice');

		$query = $this->db->get();
		return $query;
	}

	public function sum_fee($id)
	{
		$this->db->select('
							SUM(biaya_pengurusan_detail.fee_oprasional) as sum_fee, 
							SUM(biaya_pengurusan_detail.oprasional) as sum_oprasional, 
							SUM(biaya_pengurusan_detail.pajak_tax) as sum_pajak, 
							SUM(biaya_pengurusan_detail.lab) as sum_lab, 
							SUM(biaya_pengurusan_detail.jasa_perushaan) as sum_jasa_perushaan');
		$this->db->from('biaya_pengurusan_detail');
		$this->db->where('biaya_pengurusan_detail.bp_key', $id);

		$query = $this->db->get();
		return $query;
	}

	public function add_detail($post)
	{
		$params['bp_key']			= $post['bp_key'];
		$params['pt_customers']		= $post['pt_customers'];
		$params['fee_oprasional']   = str_replace(".", "", $post['fee_oprasional']);
		$params['oprasional']    	= str_replace(".", "", $post['oprasional']);
		$params['pajak_tax']     	= str_replace(".", "", $post['pajak_tax']);
		$params['lab']     			= str_replace(".", "", $post['lab']);
		$params['jasa_perushaan']   = str_replace(".", "", $post['jasa_perushaan']);
		$params['date']				= $post['date'];
		$params['user_id'] 			= $this->session->userdata('user_id');

		$this->db->insert('biaya_pengurusan_detail', $params);
	}

	public function existing_update_detail($post)
	{
		$params['bp_key']			= $post['bp_key'];
		$params['pt_customers']		= $post['pt_customers'];
		$params['fee_oprasional']   = str_replace(".", "", $post['fee_oprasional']);
		$params['oprasional']    	= str_replace(".", "", $post['oprasional']);
		$params['pajak_tax']     	= str_replace(".", "", $post['pajak_tax']);
		$params['lab']     			= str_replace(".", "", $post['lab']);
		$params['jasa_perushaan']   = str_replace(".", "", $post['jasa_perushaan']);
		$params['date']				= $post['date'];
		$params['user_id'] 			= $this->session->userdata('user_id');

		$this->db->insert('biaya_pengurusan_detail', $params);
	}

	public function edit($post)
	{
		$params['fee_oprasional']   = str_replace(".", "", $post['fee_oprasional']);
		$params['oprasional']    	= str_replace(".", "", $post['oprasional']);
		$params['pajak_tax']     	= str_replace(".", "", $post['pajak_tax']);
		$params['lab']     			= str_replace(".", "", $post['lab']);
		$params['jasa_perushaan']   = str_replace(".", "", $post['jasa_perushaan']);
		$params['updated']			= date('Y-m-d H:i:s');
		$params['user_id'] 			= $this->session->userdata('user_id');

		$this->db->where('bpd_id', $post['bpd_id']);
		$this->db->update('biaya_pengurusan_detail', $params);
	}

	public function del($post)
	{
		$this->db->where('bpd_id', $post);
		$this->db->delete('biaya_pengurusan_detail');
	}
}
