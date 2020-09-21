<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Pembayaran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		// $this->load->model(['Pembayaran_m', 'Items_m', 'Customers_m']);
		$this->load->model(['Customers_m']);
	}

	public function index()
	{
		// $item = $this->item_m->get()->result();
		// $cart = $this->sales_m->get_cart();
		$customers = $this->Customers_m->get()->result();

		$data = [
			'customers' => $customers,
		];

		$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran_add', $data);
	}

	public function v_cart_data()
	{
		$cart = $this->sales_m->get_cart();
		$data['cart'] = $cart;
		$this->load->view('transaksi/sales/v_cart_data', $data);
	}

	public function process()
	{
		$post = $this->input->post(NULL, TRUE);

		if (isset($_POST['add_cart'])) {

			$item_id    = $this->input->post('item_id');
			$check_cart = $this->sales_m->get_cart(['cart.item_id' => $item_id]);
			if ($check_cart->num_rows() > 0) {
				$this->sales_m->update_cart_qty($post);
			} else {
				$this->sales_m->add_cart($post);
			}

			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

		if (isset($_POST['edit_cart'])) {

			$this->sales_m->edit_cart($post);

			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}

		if (isset($_POST['process_payment'])) {

			$sale_id = $this->sales_m->add_sale($post);
			$cart    = $this->sales_m->get_cart()->result();
			$row     = [];
			foreach ($cart as $c => $value) {
				array_push($row, array(
					'sale_id' => $sale_id,
					'item_id' => $value->item_id,
					'price'   => $value->price,
					'qty'     => $value->qty,
					'discount_item' => $value->discount_item,
					'total' => $value->total,
				));
			}

			$this->sales_m->add_sale_detail($row);
			$this->sales_m->del_cart(['user_id' => $this->session->userdata('user_id')]);


			if ($this->db->affected_rows() > 0) {
				$params = array("success" => true, "sale_id" => $sale_id);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	public function cart_del()
	{
		$cart_id = $this->input->post('cart_id');
		$this->sales_m->del_cart(['cart_id' => $cart_id]);

		if ($this->db->affected_rows() > 0) {
			$params = array("success" => true);
		} else {
			$params = array("success" => false);
		}
		echo json_encode($params);
	}

	public function cetak($id)
	{
		$data = array(
			'sales'        => $this->sales_m->get_sale($id)->row(),
			'sales_detail' => $this->sales_m->get_sale_detail($id)->result()
		);

		$this->load->view('transaksi/sales/receipt_print', $data);
	}
}
