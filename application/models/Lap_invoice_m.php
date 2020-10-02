<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Lap_invoice_m extends CI_Model
{

	public function get()
	{
		$this->db->select('*, pembayaran.created as created_dp');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_detail', 'pembayaran_detail.pembayaran_id = pembayaran.pembayaran_id');
		$this->db->join('items', 'items.items_id = pembayaran_detail.items_id');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');
		$this->db->group_by('pembayaran.no_urut_invoice');

		$query = $this->db->get();
		return $query;
	}

	public function get_lunas($id = NULL)
	{
		$this->db->select('*, pembayaran.created as create_invoice, pembayaran_detail.harga_items as harga_pembayaran, pembayaran_detail.qty as pembayaran_qty');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_detail', 'pembayaran_detail.pembayaran_id = pembayaran.pembayaran_id');
		$this->db->join('items', 'items.items_id = pembayaran_detail.items_id');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');

		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}

	// Down Payment

	public function get_dp($id = NULL)
	{
		$this->db->select('*, 
							pembayaran.created as create_invoice,
							pembayaran_down_payment.created as created_dp,
							pembayaran.invoice as invoice_pembayaran
							');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_down_payment', 'pembayaran_down_payment.invoice = pembayaran.no_urut_invoice');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');

		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}

	public function get_sum_dp($id = NULL)
	{
		$this->db->select('SUM(pembayaran_down_payment.down_payment) as result_dp, pembayaran.total_price as total_price');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_down_payment', 'pembayaran_down_payment.invoice = pembayaran.no_urut_invoice');

		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}
}
