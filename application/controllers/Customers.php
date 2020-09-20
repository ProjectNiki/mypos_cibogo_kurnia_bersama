<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Customers_m');
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->Customers_m->get()->result();
		$this->template->load('v_template', 'master/customers/v_customers', $data);
	}

	public function add()
	{

		$data = $this->Customers_m->ai_code();

		$nourut = substr($data, 2, 4);
		$kd_ai  = $nourut + 1;
		$result = array(
			'row' => $kd_ai
		);

		$this->form_validation->set_rules('customers_key', 'Customers Key', 'trim|required|is_unique[customers.customers_key]');
		$this->form_validation->set_rules('pt_customers', 'PT Customers', 'trim|required');
		$this->form_validation->set_rules('name_customers', 'Nama Customers', 'trim|required');
		$this->form_validation->set_rules('gander_customers', 'Gander', 'trim|required');
		$this->form_validation->set_rules('phone_customers', 'No Tlp', 'trim|required');
		$this->form_validation->set_rules('email_customers', 'Email Customers', 'trim|required|valid_email');
		$this->form_validation->set_rules('address_customers', 'Alamat Costumers', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/customers/v_customers_add', $result);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Customers_m->add($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('Customers');
			}
		}
	}

	public function edit($post)
	{

		$data = $this->Customers_m->get($post)->row();

		$array = [
			'row' => $data
		];

		$this->form_validation->set_rules('customers_key', 'Customers Key', 'trim|required|is_unique[customers.customers_key]');
		$this->form_validation->set_rules('pt_customers', 'PT Customers', 'trim|required');
		$this->form_validation->set_rules('name_customers', 'Nama Customers', 'trim|required');
		$this->form_validation->set_rules('gander_customers', 'Gander', 'trim|required');
		$this->form_validation->set_rules('phone_customers', 'No Tlp', 'trim|required');
		$this->form_validation->set_rules('email_customers', 'Email Customers', 'trim|required|valid_email');
		$this->form_validation->set_rules('address_customers', 'Alamat Costumers', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/customers/v_customers_edit', $array);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Customers_m->edit($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('Customers');
			}
		}
	}

	public function del($post)
	{
		$this->Customers_m->del($post);

		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak dapat dihapus, karena suda berelasi dengan table lain</div>');
			redirect('Customers');
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus </div>');
			redirect('Customers');
		}
	}
}
