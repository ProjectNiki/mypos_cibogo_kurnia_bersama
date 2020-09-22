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
		$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran');
	}

	function generateRandomString($length = 10)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
			'dp'		=> $this->Pembayaran_m->down_payment()
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
		if (isset($_POST['process_payment'])) {

			$pembayaran_id = $this->Pembayaran_m->add_sale($post);
			$cart    = $this->Pembayaran_m->get_cart()->result();
			$row     = [];
			foreach ($cart as $c => $value) {
				array_push($row, array(
					'pembayaran_id' => $pembayaran_id,
					'items_id' => $value->items_id,
					'price'   => $value->price,
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
