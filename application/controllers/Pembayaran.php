<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Pembayaran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['Customers_m', 'Items_m', 'Pembayaran_m']);
	}

	public function index()
	{
		$result 	= $this->Pembayaran_m->get()->result();

		$data =	[
			'row' => $result,
		];

		$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran', $data);
	}

	public function preview($id)
	{
		$uri 	= $this->uri->segment(4);

		$row_lunas = $this->Pembayaran_m->get_lunas($id)->row();
		$result_lunas = $this->Pembayaran_m->get_lunas($id)->result();

		$data_lunas = [
			'row' => $row_lunas,
			'result' => $result_lunas,
		];
		// 
		$row_dp = $this->Pembayaran_m->get_dp($id)->row();
		$result_dp = $this->Pembayaran_m->get_dp($id)->result();
		$get_sum_dp = $this->Pembayaran_m->get_sum_dp($id)->row();

		$data_dp = [
			'row' => $row_dp,
			'result' => $result_dp,
			'get_sum_dp' => $get_sum_dp
		];

		if ($uri == 1) {
			$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran_lunas', $data_lunas);
		} else {
			$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran_dp', $data_dp);
		}
	}

	public function down_payment($id)
	{
		$row = $this->Pembayaran_m->get_lunas($id)->row();
		$result = $this->Pembayaran_m->get_lunas($id)->result();
		$row_dp = $this->Pembayaran_m->get_sum_dp($id)->row();

		$data = [
			'row' => $row,
			'row_dp' => $row_dp,
			'result' => $result
		];

		$this->template->load('v_template', 'transaksi/pembayaran/v_down_payment', $data);
	}

	public function process_dp()
	{
		$post = $this->input->post(NULL, TRUE);


		if (isset($_POST['process_payment'])) {

			$this->Pembayaran_m->add_pembayaran_sisa_dp($post);

			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	public function update_status_down_payment($id)
	{
		$this->Pembayaran_m->update_status_down_payment($id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Success!</strong> Data berhasil dihapus </div>');
			redirect('pembayaran');
		}
	}


	public function add()
	{
		$customers 	= $this->Customers_m->get()->result();
		$items		= $this->Items_m->get()->result();
		$cart 		= $this->Pembayaran_m->get_cart();


		$data = [
			'customers' => $customers,
			'items'		=> $items,
			'cart'      => $cart,
			'invoice'   => $this->Pembayaran_m->invoice_no(),
		];

		$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran_add', $data);
	}

	public function v_cart_data()
	{
		$cart = $this->Pembayaran_m->get_cart();
		$data['cart'] = $cart;
		$this->load->view('transaksi/pembayaran/v_cart_data', $data);
	}

	public function process()
	{
		$post = $this->input->post(NULL, TRUE);

		// Memasukan data sementara ke cart
		if (isset($_POST['add_cart'])) {

			$items_id    	= $this->input->post('items_id');
			$check_cart 	= $this->Pembayaran_m->get_cart(['cart.items_id' => $items_id]);

			if ($check_cart->num_rows() > 0) {
				$this->Pembayaran_m->update_cart_qty($post);
			} else {
				$this->Pembayaran_m->add_cart($post);
			}

			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
		// Memasukan data sementara ke cart

		// process payment
		if (isset($_POST['process_payment'])) {

			if ($post['status'] == 2) {
				$this->Pembayaran_m->add_pembayaran_dp($post);
			}

			$pembayaran_id = $this->Pembayaran_m->add_pembayaran($post);

			$cart    = $this->Pembayaran_m->get_cart()->result();
			$row     = [];
			foreach ($cart as $c => $value) {
				array_push($row, array(
					'pembayaran_id' => $pembayaran_id,
					'items_id' => $value->items_id,
					'harga_items'   => $value->harga_items,
					'qty'     => $value->qty,
					'total' => $value->total,
				));
			}

			$this->Pembayaran_m->add_pembayaran_detail($row);
			$this->Pembayaran_m->del_cart(['user_id' => $this->session->userdata('user_id')]);

			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	public function cart_del()
	{
		$cart_id = $this->input->post('cart_id');

		$this->Pembayaran_m->del_cart(['cart_id' => $cart_id]);

		if ($this->db->affected_rows() > 0) {
			$params = array("success" => true);
		} else {
			$params = array("success" => false);
		}
		echo json_encode($params);
	}
}
