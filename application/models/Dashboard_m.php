<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");
class Dashboard_m extends CI_Model
{
	public function sum_customer()
	{
		$query = $this->db->query("SELECT * FROM customers");
		$count = $query->num_rows();
		return $count;
	}

	public function sum_pendapatan()
	{
		$date = date('m');

		$this->db->select('SUM(pembayaran.total_price) as sum_pendapatan_m');
		$this->db->from('pembayaran');
		$this->db->where('MONTH(pembayaran.date) =', $date);
		$this->db->where('status =', 1);

		$post = $this->db->get();
		return $post;
	}

	public function sum_dp()
	{
		$date = date('m');

		$this->db->select('SUM(pembayaran_down_payment.down_payment) as sum_dp');
		$this->db->from('pembayaran_down_payment');
		$this->db->where('MONTH(pembayaran_down_payment.created) =', $date);

		$post = $this->db->get();
		return $post;
	}
}
