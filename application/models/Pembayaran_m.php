<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Pembayaran_m extends CI_Model
{
	public function get($id = NULL)
	{
		$this->db->select('*, pembayaran.created as created_dp');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_detail', 'pembayaran_detail.pembayaran_id = pembayaran.pembayaran_id');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');
		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}
		$this->db->group_by('pembayaran.no_urut_invoice');

		$query = $this->db->get();
		return $query;
	}

	public function ai_code()
	{
		$query = $this->db->query("SELECT MAX(no_urut_invoice) as no_urut_invoice from pembayaran");
		$hasil = $query->row();
		return $hasil->no_urut_invoice;
	}

	public function get_lunas($id = NULL)
	{
		$this->db->select('*, pembayaran.created as create_invoice, pembayaran_detail.harga_items as harga_pembayaran, pembayaran_detail.qty as pembayaran_qty');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_detail', 'pembayaran_detail.pembayaran_id = pembayaran.pembayaran_id');
		$this->db->join('items', 'items.items_id = pembayaran_detail.items_id');
		$this->db->join('sub_categories', 'sub_categories.sub_categories_id = items.sub_categories_id');
		$this->db->join('categories', 'categories.categories_id = sub_categories.categories_id');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');

		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}

	// Down Payment

	public function get_dp($id = NULL)
	{
		$this->db->select('*, 
							pembayaran.created as create_invoice,
							pembayaran_down_payment.created as created_dp,
							pembayaran.invoice as invoice_pembayaran,
							pembayaran_down_payment.noted as noted_dp
							');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_down_payment', 'pembayaran_down_payment.invoice = pembayaran.no_urut_invoice');
		$this->db->join('customers', 'customers.customers_id = pembayaran.customers_id');
		$this->db->join('user', 'user.user_id = pembayaran.user_id');

		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}

	public function get_sum_dp($id = NULL)
	{
		$this->db->select('SUM(pembayaran_down_payment.down_payment) as result_dp, pembayaran.total_price as total_price');
		$this->db->from('pembayaran');
		$this->db->join('pembayaran_down_payment', 'pembayaran_down_payment.invoice = pembayaran.no_urut_invoice');

		if ($id != NULL) {
			$this->db->where('pembayaran.pembayaran_id', $id);
		}

		$query = $this->db->get();
		return $query;
	}

	public function update_status_down_payment($id)
	{
		$params['lunas_down_payment'] = 1;

		$this->db->where('pembayaran_id', $id);
		$this->db->update('pembayaran', $params);
	}

	// 
	public function invoice_no()
	{
		$sql    = "SELECT MAX(MID(invoice,9,4)) as invoice_no 
                   FROM pembayaran 
                   WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		$query  = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n   = ((int)$row->invoice_no) + 1;
			$no  = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$invoice = "MP" . date('ymd') . $no;
		return $invoice;
	}

	public function get_cart($id = null)
	{
		$this->db->select('*, items.name_items as name_items, cart.harga_items as cart_price');
		$this->db->from('cart');
		$this->db->join('items', 'items.items_id = cart.items_id');
		if ($id != NULL) {
			$this->db->where($id);
		}

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$query = $this->db->get();
		return $query;
	}

	public function add_cart($post)
	{
		$query = $this->db->query("SELECT MAX(cart_id) as cart_no FROM cart");
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$cart_no = ((int)$row->cart_no) + 1;
		} else {
			$cart_no = 1;
		}

		$params = array(
			'cart_id'   		=> $cart_no,
			'items_id'   		=> $post['items_id'],
			'harga_items'     	=> $post['harga_items'],
			'qty'       		=> $post['qty'],
			'type_qty'       	=> $post['type_qty'],
			'qty_kg'      		=> str_replace(",", "", $post['qty']),
			'total'     		=> ($post['harga_items'] * $post['qty']),
			'user_id'   		=> $this->session->userdata('user_id')
		);

		$this->db->insert('cart', $params);
	}

	public function update_cart_qty($post)
	{
		$sql = "UPDATE cart SET harga_items = '$post[harga_items]',
                qty = qty + '$post[qty]',
                total = '$post[harga_items]' * qty
                WHERE items_id = '$post[items_id]'";

		$this->db->query($sql);
	}

	public function del_cart($post = null)
	{
		if ($post != null) {
			$this->db->where($post);
		}

		$this->db->delete('cart');
	}

	public function add_pembayaran($post)
	{
		$params = array(
			'invoice' => $post['invoice'] . '' . $post['invoice_inisial'] . '/',
			'no_urut_invoice' => $post['invoice_ai'],
			'customers_id' => $post['customers_id'],
			'total_price' => $post['subtotal'],
			'cash' => str_replace(".", "", $post['cash']),
			'status' => $post['status'],
			'payment' => $post['payment'],
			'date' => $post['date'],
			'user_id' => $this->session->userdata('user_id')
		);

		if ($post['noted'] != NULL) {
			$params['noted'] = $post['noted'];
		}

		$this->db->insert('pembayaran', $params);
		return $this->db->insert_id();
	}

	public function add_pembayaran_dp($post)
	{
		$params = array(
			'invoice' => $post['invoice_ai'],
			'down_payment' => str_replace(".", "", $post['down_payment']),
			'down_payment_id' => $post['down_payment_id'],
			'payment_dp' => $post['payment'],
			'user_id' => $this->session->userdata('user_id')
		);

		$this->db->insert('pembayaran_down_payment', $params);
	}

	public function add_pembayaran_sisa_dp($post)
	{
		$params = array(
			'invoice' => $post['invoice'],
			'down_payment' => str_replace(".", "", $post['down_payment']),
			'down_payment_id' => $post['down_payment_id'],
			'payment_dp' => $post['payment'],
			'user_id' => $this->session->userdata('user_id')
		);

		if ($post['noted'] != NULL) {
			$params['noted'] = $post['noted'];
		}


		$this->db->insert('pembayaran_down_payment', $params);
	}

	function add_pembayaran_detail($params)
	{
		$this->db->insert_batch('pembayaran_detail', $params);
	}

	public function get_sale($id = null)
	{
		$this->db->select('*, customers.name_customers as customers_name, user.name as user_name, sales.create as sales_created, sales.customers_id as customers_sales');
		$this->db->from('sales');
		$this->db->join('customers', 'customers.customers_id = sales.customers_id', 'LEFT');
		$this->db->join('user', 'user.user_id = sales.user_id');
		if ($id != NULL) {
			$this->db->where('sales.sale_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_sale_detail($id = null)
	{
		$this->db->from('sales_detail');
		$this->db->join('item', 'item.item_id = sales_detail.item_id');
		if ($id != NULL) {
			$this->db->where('sales_detail.sale_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}
}
