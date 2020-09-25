<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_invoice extends CI_Controller
{
	function __construct()
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
		$tgl    = date('Y-m-d');

		$status	= $this->Lap_invoice_m->get_id($id)->row()->status;
		$row 	= $this->Lap_invoice_m->get_id($id)->row();
		$result = $this->Lap_invoice_m->get_id($id)->result();

		$data = [
			'row' => $row,
			'result' => $result
		];

		if ($status == 1) {
			$html = $this->load->view('laporan/laporan_invoice/v_lap_invoice_dp', $data, true);
			$this->fungsi->PdfGenerator($html, 'Lap_pengeluaran_' . $tgl, 'A4', 'landscape');
		} else {
			$html = $this->load->view('laporan/laporan_invoice/v_lap_invoice_lunas', $data, true);
			$this->fungsi->PdfGenerator($html, 'Lap_pengeluaran_' . $tgl, 'A4', 'landscape');
		}
	}
}
