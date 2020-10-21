<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Categories_m', 'Sub_categories_m', 'Items_m']);
		$this->load->library('form_validation');
		check_not_login();
	}

	public function index()
	{
		$data['row'] = $this->Items_m->get_item()->result();
		$this->template->load('v_template', 'master/items/v_items', $data);
	}

	public function add()
	{
		$categories 	= $this->Categories_m->get()->result();
		$ai_code 		= $this->Items_m->ai_code();

		$nourut = substr($ai_code, 2, 4);
		$kd_ai  = $nourut + 1;

		$data = [
			'categories' => $categories,
			'row' => $kd_ai
		];

		$this->form_validation->set_rules('items_key', 'Items Key', 'trim|required|is_unique[items.items_key]');
		$this->form_validation->set_rules('name_items', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('categories_id', 'Categories Id', 'trim|required');
		$this->form_validation->set_rules('sub_categories_id', 'Sub Categories Id', 'trim|required');
		$this->form_validation->set_rules('harga_items', 'Harga Items', 'trim|required');
		$this->form_validation->set_rules('type_qty', 'Satuan', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'master/items/v_items_add', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Items_m->add($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('items');
			}
		}
	}

	public function edit($id)
	{
		$type_qty 		= $this->uri->segment(4);

		$items 			= $this->Items_m->get($id)->row();
		$categories 	= $this->Categories_m->get()->result();

		$data  = [
			'items' => $items,
			'categories' => $categories
		];

		if ($type_qty == 'pcs') {
			$this->template->load('v_template', 'master/items/v_items_edit_pcs', $data);
		} else {
			$this->template->load('v_template', 'master/items/v_items_edit_kg', $data);
		}
	}

	public function process_edit_pcs()
	{
		$post = $this->input->post(NULL, TRUE);

		$this->Items_m->edit_pcs($post);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
			redirect('items');
		}
	}

	public function process_edit_kg()
	{
		$post = $this->input->post(NULL, TRUE);

		$this->Items_m->edit_kg($post);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
			redirect('items');
		}
	}


	function get_subkategori()
	{
		$id     = $this->input->post('id');
		$data   = $this->Sub_categories_m->get_sub_categories($id)->result();
		echo json_encode($data);
	}




	public function del($id)
	{
		$this->Items_m->del_stock_in($id);
		$this->Items_m->del_stock_out($id);
		$this->Items_m->del($id);

		$error = $this->db->error();
		if ($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak dapat dihapus, karena suda berelasi dengan table lain</div>');
			redirect('items');
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus</div>');
			redirect('items');
		}
	}
}
