<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Admin_m');
		check_not_login();
	}

	public function index()
	{
		$this->template->load('v_template', 'admin/v_admin');
	}

	public function edit()
	{

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'matches[retype_password]');
		$this->form_validation->set_rules('retype_password', 'Password Confirmation', 'matches[password]');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'admin/v_admin');;
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Admin_m->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('admin');
			}
		}
	}
}
