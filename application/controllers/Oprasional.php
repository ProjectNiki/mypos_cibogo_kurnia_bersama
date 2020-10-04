<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oprasional extends CI_Controller
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
		$pembayaran['row'] = $this->Oprasional_m->get()->result();
		$this->template->load('v_template', 'transaksi/oprasional/v_oprasional', $pembayaran);
	}

	public function add()
	{

		$this->form_validation->set_rules('invoice', 'invoice', 'trim|required');
		$this->form_validation->set_rules('fee_oprasional', 'Fee', 'trim|required');
		$this->form_validation->set_rules('oprasional', 'Oprasional', 'trim|required');
		$this->form_validation->set_rules('pajak_tax', 'Pajak/tax', 'trim|required');
		$this->form_validation->set_rules('lab', 'Lab', 'trim|required');
		$this->form_validation->set_rules('jasa_perushaan', 'Jasa Perusahaan', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$pembayaran['row'] = $this->Oprasional_m->get_oprasional()->result();

			$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_add', $pembayaran);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Oprasional_m->edit_status($post);
			$this->Oprasional_m->add($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('oprasional');
			}
		}
	}

	public function del($post)
	{
		$this->Oprasional_m->del($post);

		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak dapat dihapus, karena suda berelasi dengan table lain</div>');
			redirect('oprasional');
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus </div>');
			redirect('oprasional');
		}
	}
}
