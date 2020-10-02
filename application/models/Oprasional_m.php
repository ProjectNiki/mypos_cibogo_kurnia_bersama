<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oprasional_m extends CI_Model
{

	public function get($id = NULL)
	{
		$this->db->select('*, biaya_pengurusan.created as created_pengurusan, pembayaran.invoice as invoice_pembayaran');
		$this->db->from('pembayaran');
		$this->db->join('biaya_pengurusan', 'biaya_pengurusan.invoice = pembayaran.no_urut_invoice');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');
		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
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

	public function get_laporan()
	{
		$this->db->select('*, biaya_pengurusan.created as created_pengurusan, pembayaran.invoice as invoice_pembayaran');
		$this->db->from('pembayaran');
		$this->db->join('biaya_pengurusan', 'biaya_pengurusan.invoice = pembayaran.no_urut_invoice');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');
		$this->db->group_by('biaya_pengurusan.invoice');

		$query = $this->db->get();
		return $query;
	}

	public function sum_fee($id)
	{
		$this->db->select('
							SUM(biaya_pengurusan.fee_oprasional) as sum_fee, 
							SUM(biaya_pengurusan.oprasional) as sum_oprasional, 
							SUM(biaya_pengurusan.pajak_tax) as sum_pajak, 
							SUM(biaya_pengurusan.lab) as sum_lab, 
							SUM(biaya_pengurusan.jasa_perushaan) as sum_jasa_perushaan');
		$this->db->from('pembayaran');
		$this->db->join('biaya_pengurusan', 'biaya_pengurusan.invoice = pembayaran.no_urut_invoice');
		$this->db->where('pembayaran.pembayaran_id', $id);

		$query = $this->db->get();
		return $query;
	}

	public function add($post)
	{
		$params['invoice']			= $post['no_urut_invoice'];
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
