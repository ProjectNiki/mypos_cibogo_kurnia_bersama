<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_invoice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Lap_invoice_m']);
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->Lap_invoice_m->get()->result();
		$this->template->load('v_template', 'laporan/laporan_invoice/v_lap_invoice', $data);
	}

	public function cetak_lap_invoice($id)
	{
		$tgl = date('Y-m-d');

		$uri 	= $this->uri->segment(4);
		// 
		$row_lunas = $this->Lap_invoice_m->get_lunas($id)->row();
		$result_lunas = $this->Lap_invoice_m->get_lunas($id)->result();

		$data_lunas = [
			'row' => $row_lunas,
			'result' => $result_lunas,
		];
		// 
		$row_dp = $this->Lap_invoice_m->get_dp($id)->row();
		$result_dp = $this->Lap_invoice_m->get_dp($id)->result();
		$get_sum_dp = $this->Lap_invoice_m->get_sum_dp($id)->row();

		$data_dp = [
			'row' => $row_dp,
			'result' => $result_dp,
			'get_sum_dp' => $get_sum_dp
		];
		// 

		if ($uri == 1) {
			$html = $this->load->view('laporan/laporan_invoice/v_lap_invoice_lunas', $data_lunas, true);
			$this->fungsi->PdfGenerator($html, 'Lap_pengeluaran_' . $tgl, 'A4', 'landscape');
		} else {
			$html = $this->load->view('laporan/laporan_invoice/v_lap_invoice_dp', $data_dp, true);
			$this->fungsi->PdfGenerator($html, 'Lap_pengeluaran_' . $tgl, 'A4', 'landscape');
		}
	}

	public function cetak_preview_dp($id)
	{
		$tgl = date('Y-m-d');

		$row_preview_dp = $this->Lap_invoice_m->get_lunas($id)->row();
		$result_preview_dp = $this->Lap_invoice_m->get_lunas($id)->result();

		$data_lunas = [
			'row' => $row_preview_dp,
			'result' => $result_preview_dp,
		];

		$html = $this->load->view('laporan/laporan_invoice/v_lap_invoice_dp_preview', $data_lunas, true);
		$this->fungsi->PdfGenerator($html, 'Lap_pengeluaran_' . $tgl, 'A4', 'landscape');
	}
}
