<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['Dashboard_m']);
	}

	public function index()
	{
		$customer = $this->Dashboard_m->sum_customer();
		$pendapatan = $this->Dashboard_m->sum_pendapatan()->result();
		$pendapatan_dp = $this->Dashboard_m->sum_dp()->result();
		$get_out_sum = $this->Dashboard_m->get_out_sum()->row();
		$get_in_sum = $this->Dashboard_m->get_in_sum()->row();

		$data = [
			'customer' => $customer,
			'pendapatan' => $pendapatan,
			'pendapatan_dp' => $pendapatan_dp,
			'get_out_sum' => $get_out_sum,
			'get_in_sum' => $get_in_sum
		];

		$this->template->load('v_template', 'v_dashboard', $data);
	}
}
