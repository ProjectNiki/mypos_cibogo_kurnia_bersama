<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_categories extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(['Sub_categories_m', 'Categories_m']);
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->Sub_categories_m->get()->result();
		$this->template->load('v_template', 'master/sub_categories/v_sub_categories', $data);
	}

	public function add()
	{

		$this->form_validation->set_rules('name_sub_categories', 'Nama Sub Categories', 'trim|required');
		$this->form_validation->set_rules('categories_id', 'Nama Categories', 'trim|required');

		$data = $this->Categories_m->get()->result();

		$array = [
			'row' => $data
		];

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/sub_categories/v_sub_categories_add', $array);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Sub_categories_m->add($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('sub_categories');
			}
		}
	}

	public function edit($post)
	{

		$data 		= $this->Sub_categories_m->get($post)->row();
		$categories = $this->Categories_m->get()->result();


		$array = [
			'row' => $data,
			'categories' => $categories
		];

		$this->form_validation->set_rules('name_sub_categories', 'Nama Sub Categories', 'trim|required');
		$this->form_validation->set_rules('categories_id', 'Nama Categories', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/sub_categories/v_sub_categories_edit', $array);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Sub_categories_m->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('sub_categories');
			}
		}
	}

	public function del($post)
	{
		$this->Sub_categories_m->del($post);

		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak dapat dihapus, karena suda berelasi dengan table lain</div>');
			redirect('sub_categories');
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus </div>');
			redirect('sub_categories');
		}
	}
}
