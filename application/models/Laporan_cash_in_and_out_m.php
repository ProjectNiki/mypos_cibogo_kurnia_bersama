<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");
class Laporan_cash_in_and_out_m extends CI_Model
{
	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('cash_in_cash_out');

		if ($id != null) {
			$this->db->where('cash_in_cash_out.date >=', $id['start']);
			$this->db->where('cash_in_cash_out.date <=', $id['end']);
		}

		$post = $this->db->get();
		return $post;
	}

	public function get_in($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('cash_in_cash_out');

		if ($id != null) {
			$this->db->where('cash_in_cash_out.date >=', $id['start']);
			$this->db->where('cash_in_cash_out.date <=', $id['end']);
			$this->db->where('type =', 'In');
		}

		$post = $this->db->get();
		return $post;
	}

	public function get_in_sum($id = NULL)
	{
		$this->db->select('SUM(cash_in_cash_out.total) as grand_total_in');
		$this->db->from('cash_in_cash_out');

		if ($id != null) {
			$this->db->where('cash_in_cash_out.date >=', $id['start']);
			$this->db->where('cash_in_cash_out.date <=', $id['end']);
			$this->db->where('type =', 'In');
		}

		$post = $this->db->get();
		return $post;
	}


	public function get_out($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('cash_in_cash_out');

		if ($id != null) {
			$this->db->where('cash_in_cash_out.date >=', $id['start']);
			$this->db->where('cash_in_cash_out.date <=', $id['end']);
			$this->db->where('type =', 'Out');
		}

		$post = $this->db->get();
		return $post;
	}

	public function get_out_sum($id = NULL)
	{
		$this->db->select('SUM(cash_in_cash_out.total) as grand_total_out');
		$this->db->from('cash_in_cash_out');

		if ($id != null) {
			$this->db->where('cash_in_cash_out.date >=', $id['start']);
			$this->db->where('cash_in_cash_out.date <=', $id['end']);
			$this->db->where('type =', 'Out');
		}

		$post = $this->db->get();
		return $post;
	}
}
