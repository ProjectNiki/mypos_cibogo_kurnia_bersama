<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Pembayaran extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['Customers_m', 'Items_m', 'Pembayaran_m', 'Lap_invoice_m']);
	}

	public function index()
	{
		$result 	= $this->Pembayaran_m->get()->result();

		$data =	[
			'row' => $result,
		];

		$this->template->load('v_template', 'transaksi/pembayaran/v_pembayaran', $data);
	}

	public function cetak_dp($id)
	{
		$tgl = date('Y-m-d H:i:s');

		$row_dp = $this->Lap_invoice_m->get_dp($id)->row();
		$result_dp = $this->Lap_invoice_m->get_dp($id)->result();
		$get_sum_dp = $this->Lap_invoice_m->get_sum_dp($id)->row();
		$row_preview_dp = $this->Lap_invoice_m->get_lunas($id)->row();
		$result_preview_dp = $this->Lap_invoice_m->get_lunas($id)->result();


		$data_dp = [
			'row' => $row_dp,
			'result' => $result_dp,
			'get_sum_dp' => $get_sum_dp,
			'row_data' => $row_preview_dp,
			'result_data' => $result_preview_dp
		];

		$html = $this->load->view('transaksi/pembayaran/v_cetak_dp', $data_dp, true);
		$this->fungsi->PdfGenerator($html, 'Lap_Invoice_' . $tgl, 'A4', 'landscape');
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
			$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Data berhasil diupdate </div>');
			redirect('pembayaran');
		}
	}


	public function add()
	{
		$customers 	= $this->Customers_m->get()->result();
		$items		= $this->Items_m->get()->result();
		$cart 		= $this->Pembayaran_m->get_cart();
		$data 		= $this->Pembayaran_m->ai_code();



		$nourut = substr($data, 1, 5);
		$kd_ai  = $nourut + 1;

		$data = [
			'customers' => $customers,
			'items'		=> $items,
			'cart'      => $cart,
			'row' 		=> $kd_ai
			// 'invoice'   => $this->Pembayaran_m->invoice_no(),
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
					'type_qty'     => $value->type_qty,
					'qty_kg'     => $value->qty_kg,
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
