<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Categories_m');
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->Categories_m->get()->result();
		$this->template->load('v_template', 'master/categories/v_categories', $data);
	}

	public function add()
	{

		$this->form_validation->set_rules('name_categories', 'Nama Categories', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/categories/v_categories_add');
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Categories_m->add($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('categories');
			}
		}
	}

	public function edit($post)
	{

		$data = $this->Categories_m->get($post)->row();

		$array = [
			'row' => $data
		];

		$this->form_validation->set_rules('name_categories', 'Nama Categories', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/categories/v_categories_edit', $array);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Categories_m->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('categories');
			}
		}
	}

	public function del($post)
	{
		$this->Categories_m->del($post);

		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak dapat dihapus, karena suda berelasi dengan table lain</div>');
			redirect('categories');
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus </div>');
			redirect('categories');
		}
	}
}
