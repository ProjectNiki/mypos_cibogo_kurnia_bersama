<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_in_m extends CI_Model
{

	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('stock_in');
		$this->db->join('items', 'items.items_id = stock_in.items_id', 'LEFT');
		$this->db->join('user', 'user.user_id = stock_in.user_created', 'LEFT');
		if ($id != NULL) {
			$this->db->where('stock_in_id', $id);
		}
		return $this->db->get();
	}

	public function add($post)
	{
		$params['items_id']     = $post['items_id'];
		$params['type']         = 'In';
		$params['detail']       = $post['detail'];
		$params['date']         = $post['date'];
		$params['qty_stock_in'] = $post['qty_stock_in'];
		$params['user_created'] = $this->session->userdata('user_id');

		$this->db->insert('stock_in', $params);
	}

	public function update_stock_in_item($post)
	{
		$qty    = $post['qty_stock_in'];
		$id     = $post['items_id'];

		$sql    = "UPDATE items SET qty_items = qty_items + '$qty' WHERE items_id = '$id' ";
		$this->db->query($sql);
	}

	public function del_stock_in_item($data)
	{
		$qty    = $data['qty_stock_in'];
		$id     = $data['items_id'];

		$sql    = "UPDATE items SET qty_items = qty_items - '$qty' WHERE items_id = '$id' ";
		$this->db->query($sql);
	}

	public function del_stock_in($id)
	{
		$this->db->where('stock_in_id', $id);
		$this->db->delete('stock_in');
	}
}
