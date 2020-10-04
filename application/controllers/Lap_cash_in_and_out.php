<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_cash_in_and_out extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('Laporan_cash_in_and_out_m');
	}

	public function index()
	{
		$data['row'] = $this->Laporan_cash_in_and_out_m->get()->result();
		$this->template->load('v_template', 'laporan/laporan_cash_in_and_out/v_laporan_cash_in_and_out', $data);
	}


	function get_data()
	{
		$tgl    = date('Y-m-d H:i:s');
		$post   = $this->input->post(NULL, TRUE);

		$start  = $post['start'];
		$end    = $post['end'];

		// Cash In
		$get_in		= $this->Laporan_cash_in_and_out_m->get_in($post)->result();
		$get_in_sum	= $this->Laporan_cash_in_and_out_m->get_in_sum($post)->row();

		// Cash Out
		$get_out		= $this->Laporan_cash_in_and_out_m->get_out($post)->result();
		$get_out_sum	= $this->Laporan_cash_in_and_out_m->get_out_sum($post)->row();

		$data = [
			'start'      	=> $start,
			'end'        	=> $end,
			'get_in'     	=> $get_in,
			'get_in_sum' 	=> $get_in_sum,
			'get_out'    	=> $get_out,
			'get_out_sum' 	=> $get_out_sum
		];


		$html = $this->load->view('laporan/laporan_cash_in_and_out/v_result_laporan_cash_in_and_out', $data, true);
		$this->fungsi->PdfGenerator($html, 'Laporan_cash_in_and_out' . $tgl, 'A4', 'landscape');
	}
}
