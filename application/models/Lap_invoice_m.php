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
		$this->db->join('pembayaran_down_payment', 'pembayaran_down_payment.invoice = pembayaran.invoice');
		$this->db->join('items', 'items.items_id = pembayaran_detail.items_id');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');
		$this->db->group_by('pembayaran.invoice');

		$query = $this->db->get();
		return $query;
	}

	public function get_id($id = NULL)
	{
		$this->db->select('*, pembayaran.created as create_invoice');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_detail', 'pembayaran_detail.pembayaran_id = pembayaran.pembayaran_id');
		$this->db->join('pembayaran_down_payment', 'pembayaran_down_payment.invoice = pembayaran.invoice');
		$this->db->join('items', 'items.items_id = pembayaran_detail.items_id');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');
		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}
}
