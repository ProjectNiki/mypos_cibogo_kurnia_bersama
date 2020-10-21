<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cash_in_and_out extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('form_validation');
		$this->load->model('Cash_in_and_out_m');
	}

	public function index()
	{
		$data['row'] = $this->Cash_in_and_out_m->get()->result();
		$this->template->load('v_template', 'transaksi/cash_in_and_out/v_cash_in_and_out', $data);
	}

	public function add_cash_in_and_out()
	{
		$post = $this->input->post(NULL, TRUE);

		if ($post['type'] == 1) {
			$this->template->load('v_template', 'transaksi/cash_in_and_out/v_cash_in');
		} else {
			$this->template->load('v_template', 'transaksi/cash_in_and_out/v_cash_out');
		}
	}

	public function edit()
	{

		$type 	= $this->uri->segment(4);
		$id 	= $this->uri->segment(3);

		$data = $this->Cash_in_and_out_m->get($id)->row();

		$array = [
			'row' => $data
		];

		if ($type == 'In') {
			$this->template->load('v_template', 'transaksi/cash_in_and_out/v_cash_in_edit', $array);
		} else if ($type == 'Out') {
			$this->template->load('v_template', 'transaksi/cash_in_and_out/v_cash_out_edit', $array);
		}
	}

	public function del($id)
	{

		$this->Cash_in_and_out_m->del($id);

		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak dapat dihapus, karena suda berelasi dengan table lain</div>');
			redirect('cash_in_and_out');
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus </div>');
			redirect('cash_in_and_out');
		}
	}

	public function proses_edit()
	{
		$post = $this->input->post(NULL, TRUE);

		if ($post['type_in'] == 'In') {
			$this->Cash_in_and_out_m->edit_in($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('cash_in_and_out');
			}
		} else if ($post['type_out'] == 'Out') {
			$this->Cash_in_and_out_m->edit_out($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('cash_in_and_out');
			}
		}
	}

	public function proses()
	{
		$post = $this->input->post(NULL, TRUE);

		if ($post['type_in'] == 'In') {
			$this->Cash_in_and_out_m->add_in($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('cash_in_and_out');
			}
		} else if ($post['type_out'] == 'Out') {
			$this->Cash_in_and_out_m->add_out($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('cash_in_and_out');
			}
		}
	}
}
