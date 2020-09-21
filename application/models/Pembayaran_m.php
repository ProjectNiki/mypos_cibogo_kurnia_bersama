<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class sales_m extends CI_Model
{
	public function invoice_no()
	{
		$sql    = "SELECT MAX(MID(invoice,9,4)) as invoice_no 
                   FROM sales 
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
		$this->db->select('*, item.item_name as item_name, cart.price as cart_price');
		$this->db->from('cart');
		$this->db->join('item', 'item.item_id = cart.item_id');
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
			'cart_id'   => $cart_no,
			'item_id'   => $post['item_id'],
			'price'     => $post['price'],
			'discount_item'   => 0,
			'qty'       => $post['qty'],
			'total'     => ($post['price'] * $post['qty']),
			'user_id'   => $this->session->userdata('user_id')
		);

		$this->db->insert('cart', $params);
	}

	public function update_cart_qty($post)
	{
		$sql = "UPDATE cart SET price = '$post[price]',
                qty = qty + '$post[qty]',
                total = '$post[price]' * qty
                WHERE item_id = '$post[item_id]'";

		$this->db->query($sql);
	}

	public function del_cart($post = null)
	{
		if ($post != null) {
			$this->db->where($post);
		}

		$this->db->delete('cart');
	}

	public function edit_cart($post)
	{
		$params = array(
			'price' => $post['price'],
			'qty' => $post['qty'],
			'discount_item' => $post['discount'],
			'total' => $post['total'],
		);

		$this->db->where('cart_id', $post['cart_id']);
		$this->db->update('cart', $params);
	}

	public function add_sale($post)
	{
		$params = array(
			'invoice' => $this->invoice_no(),
			'customers_id' => $post['customers_id'],
			'total_price' => $post['subtotal'],
			'discount' => $post['discount'],
			'final_price' => $post['grandtotal'],
			'cash' => $post['cash'],
			'remaining' => $post['change'],
			'note' => $post['note'],
			'date' => $post['date'],
			'user_id' => $this->session->userdata('user_id')
		);

		$this->db->insert('sales', $params);
		return $this->db->insert_id();
	}

	function add_sale_detail($params)
	{
		$this->db->insert_batch('sales_detail', $params);
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
