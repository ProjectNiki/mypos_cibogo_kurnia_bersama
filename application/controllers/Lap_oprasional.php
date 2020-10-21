<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_oprasional extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(['Pembayaran_m', 'Oprasional_m']);
		check_not_login();
	}

	public function index()
	{
		$pembayaran['row'] = $this->Oprasional_m->get_laporan()->result();
		$this->template->load('v_template', 'laporan/laporan_oprasional/v_lap_oprasional', $pembayaran);
	}

	public function cetak_lap_oprasional($id)
	{
		$tgl = date('Y-m-d H:i:s');

		$row_preview 		= $this->Oprasional_m->get_cetak($id)->row();
		$result_preview 	= $this->Oprasional_m->get_cetak($id)->result();
		$row_sum			= $this->Oprasional_m->sum_fee($id)->row();

		$data = [
			'row' => $row_preview,
			'result' => $result_preview,
			'row_sum' => $row_sum
		];

		$html = $this->load->view('laporan/laporan_oprasional/v_lap_cetak_oprasional', $data, true);
		$this->fungsi->PdfGenerator($html, 'Lap_pengurusan_' . $tgl, 'A4', 'landscape');
	}
}
