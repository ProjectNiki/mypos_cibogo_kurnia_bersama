<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Bangkok");

class Items_m extends CI_Model
{

	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('items');
		$this->db->join('categories', 'categories.categories_id = items.categories_id');
		$this->db->join('sub_categories', 'sub_categories.sub_categories_id = items.sub_categories_id');
		if ($id != NULL) {
			$this->db->where('items_id', $id);
		}
		$post = $this->db->get();
		return $post;
	}

	public function ai_code()
	{
		$query = $this->db->query("SELECT MAX(items_key) as items_key from items");
		$hasil = $query->row();
		return $hasil->items_key;
	}

	public function add($post)
	{

		$params['items_key']      		= $post['items_key'];
		$params['name_items']      		= $post['name_items'];
		$params['categories_id']      	= $post['categories_id'];
		$params['sub_categories_id']    = $post['sub_categories_id'];
		$params['harga_items']      	= str_replace(".", "", $post['harga_items']);
		$params['qty_items']      		= str_replace(".", "", $post['qty_items']);
		$params['user_created']      	= $this->session->userdata('user_id');

		$this->db->insert('items', $params);
	}

	public function del_stock_in($id)
	{
		$this->db->where('items_id', $id);
		$this->db->delete('stock_in');
	}

	public function del_stock_out($id)
	{
		$this->db->where('items_id', $id);
		$this->db->delete('stock_out');
	}

	public function del($id)
	{
		$this->db->where('items_id', $id);
		$this->db->delete('items');
	}
}
