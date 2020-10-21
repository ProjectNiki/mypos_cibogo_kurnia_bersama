<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oprasional extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(['Oprasional_m']);
		check_not_login();
	}

	public function index()
	{
		$pembayaran['row'] = $this->Oprasional_m->get()->result();
		$this->template->load('v_template', 'transaksi/oprasional/v_oprasional', $pembayaran);
	}

	public function oprasional_option()
	{
		$post = $this->input->post(NULL, TRUE);

		$ai_code 		= $this->Oprasional_m->ai_code();
		$nourut 		= substr($ai_code, 3, 4);
		$kd_ai  		= $nourut + 1;

		$existing_update = $this->Oprasional_m->get_existing()->result();

		$data = [
			'row' => $kd_ai,
			'existing' => $existing_update
		];

		if ($post['type'] == 1) {
			$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_add', $data);
		} else {
			$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_existing_update', $data);
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('bp_key', 'Perusahaan', 'trim|required');
		$this->form_validation->set_rules('pt_customers', 'Perusahaan', 'trim|required');
		$this->form_validation->set_rules('fee_oprasional', 'Fee', 'trim|required');
		$this->form_validation->set_rules('oprasional', 'Oprasional', 'trim|required');
		$this->form_validation->set_rules('pajak_tax', 'Pajak/tax', 'trim|required');
		$this->form_validation->set_rules('lab', 'Lab', 'trim|required');
		$this->form_validation->set_rules('jasa_perushaan', 'Jasa Perusahaan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$row = $this->Oprasional_m->get($id)->row();
			$data = [
				'row' => $row
			];

			$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_edit', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$this->Oprasional_m->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('oprasional');
			}
		}
	}

	public function existing_update()
	{

		$this->form_validation->set_rules('bp_key', 'Perusahaan', 'trim|required');
		$this->form_validation->set_rules('pt_customers', 'Perusahaan', 'trim|required');
		$this->form_validation->set_rules('fee_oprasional', 'Fee', 'trim|required');
		$this->form_validation->set_rules('oprasional', 'Oprasional', 'trim|required');
		$this->form_validation->set_rules('pajak_tax', 'Pajak/tax', 'trim|required');
		$this->form_validation->set_rules('lab', 'Lab', 'trim|required');
		$this->form_validation->set_rules('jasa_perushaan', 'Jasa Perusahaan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$existing_update = $this->Oprasional_m->get_existing()->result();

			$data = [
				'existing' => $existing_update
			];

			$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_existing_update', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$this->Oprasional_m->existing_update_detail($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('oprasional');
			}
		}
	}

	public function add()
	{

		$this->form_validation->set_rules('bp_key', 'Perusahaan', 'trim|required');
		$this->form_validation->set_rules('pt_customers', 'Perusahaan', 'trim|required');
		$this->form_validation->set_rules('fee_oprasional', 'Fee', 'trim|required');
		$this->form_validation->set_rules('oprasional', 'Oprasional', 'trim|required');
		$this->form_validation->set_rules('pajak_tax', 'Pajak/tax', 'trim|required');
		$this->form_validation->set_rules('lab', 'Lab', 'trim|required');
		$this->form_validation->set_rules('jasa_perushaan', 'Jasa Perusahaan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {

			$ai_code 		= $this->Oprasional_m->ai_code();
			$nourut 		= substr($ai_code, 3, 4);
			$kd_ai  		= $nourut + 1;

			$data = [
				'row' => $kd_ai
			];

			$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_add', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);
			$this->Oprasional_m->add_detail($post);

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
