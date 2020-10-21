<?php defined('BASEPATH') or exit('No direct script access allowed');

class Stock_in extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->library('form_validation');
		$this->load->model(['Items_m', 'Stock_in_m']);
	}

	public function index()
	{
		$data['row'] = $this->Stock_in_m->get()->result();
		$this->template->load('v_template', 'transaksi/stock_in/v_stock_in', $data);
	}

	public function stock_in_add()
	{
		$item        = $this->Items_m->get()->result();

		$data = [
			'row' => $item,
		];

		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('name_items', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('qty_items', 'Qty Items', 'trim|required');
		$this->form_validation->set_rules('qty_stock_in', 'Qty Stock In', 'trim|required');
		$this->form_validation->set_rules('detail', 'Detail', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'transaksi/stock_in/v_stock_in_add', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Stock_in_m->add($post);
			$this->Stock_in_m->update_stock_in_item($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('stock_in');
			}
		}
	}

	public function stock_in_add_kg()
	{
		$item        = $this->Items_m->get()->result();

		$data = [
			'row' => $item,
		];

		$this->form_validation->set_rules('date', 'Date', 'trim|required');
		$this->form_validation->set_rules('name_items', 'Nama Items', 'trim|required');
		$this->form_validation->set_rules('qty_items_kg', 'Kg Items', 'trim|required');
		$this->form_validation->set_rules('qty_stock_in_kg', 'Kg Stock In', 'trim|required');
		$this->form_validation->set_rules('detail', 'Detail', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('v_template', 'transaksi/stock_in/v_stock_in_add_kg', $data);
		} else {
			$post = $this->input->post(NULL, TRUE);

			$this->Stock_in_m->add_kg($post);
			$this->Stock_in_m->update_stock_in_item_kg($post);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil disimpan</div>');
				redirect('stock_in');
			}
		}
	}

	public function add()
	{
		$post 		= $this->input->post(NULL, TRUE);

		$item       = $this->Items_m->get()->result();

		$data = [
			'row' => $item,
		];

		if ($post['type'] == 'kg') {
			$this->template->load('v_template', 'transaksi/stock_in/v_stock_in_add_kg', $data);
		} else {
			$this->template->load('v_template', 'transaksi/stock_in/v_stock_in_add', $data);
		}
	}

	public function del()
	{
		$stock_id 	= $this->uri->segment(3);
		$items_id 	= $this->uri->segment(4);
		$type 	= $this->uri->segment(5);

		$qty_stock 		= $this->Items_m->get($items_id)->row()->qty_items;
		$qty_stock_in 	= $this->Stock_in_m->get($stock_id)->row()->qty_stock_in;
		$qty_stock_kg 		= $this->Items_m->get($items_id)->row()->qty_items_kg;
		$qty_stock_in_kg 	= $this->Stock_in_m->get($stock_id)->row()->qty_stock_in_kg;

		$data     	= [
			'qty_stock_in'     	=> $qty_stock_in,
			'items_id'   		=> $items_id,
			'qty_stock_in_kg'	=> $qty_stock_in_kg
		];

		if ($qty_stock_kg < $qty_stock_in_kg) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Dangger!</strong> Data gagal dihapus karena jumlah Kg Items kurang dari 0.00 </div>');
			redirect('stock_in');
		}

		if ($qty_stock < $qty_stock_in) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Dangger!</strong> Data gagal dihapus karena jumlah pcs Items kurang dari 0 </div>');
			redirect('stock_in');
		}

		if($type == 'Kg'){ 
			$this->Stock_in_m->del_stock_in_item_kg($data);
			$this->Stock_in_m->del_stock_in_kg($stock_id);
		}else {
			$this->Stock_in_m->del_stock_in_item($data);
			$this->Stock_in_m->del_stock_in($stock_id);
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus</div>');
			redirect('stock_in');
		}
	}
}
