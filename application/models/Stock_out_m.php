<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_out_m extends CI_Model
{

	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('stock_out');
		$this->db->join('items', 'items.items_id = stock_out.items_id', 'LEFT');
		$this->db->join('user', 'user.user_id = stock_out.user_created', 'LEFT');
		if ($id != NULL) {
			$this->db->where('stock_out_id', $id);
		}
		return $this->db->get();
	}

	public function add($post)
	{
		$params['items_id']     	= $post['items_id'];
		$params['type']         	= 'Out';
		$params['detail']       	= $post['detail'];
		$params['date']         	= $post['date'];
		$params['qty_stock_out'] 	= str_replace(".", "", $post['qty_stock_out']);
		$params['user_created'] 	= $this->session->userdata('user_id');

		$this->db->insert('stock_out', $params);
	}

	public function update_stock_out_item($post)

	{

		$qty    = str_replace(".", "", $post['qty_stock_out']);
		$id     = $post['items_id'];

		$sql    = "UPDATE items SET qty_items = qty_items - '$qty' WHERE items_id = '$id' ";
		$this->db->query($sql);
	}

	public function del_stock_out_item($data)
	{
		$qty    = $data['qty_stock_out'];
		$id     = $data['items_id'];

		$sql    = "UPDATE items SET qty_items = qty_items + '$qty' WHERE items_id = '$id' ";
		$this->db->query($sql);
	}

	public function del_stock_out($id)
	{
		$this->db->where('stock_out_id', $id);
		$this->db->delete('stock_out');
	}
}
