<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");
class Sub_categories_m extends CI_Model
{
	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('sub_categories');

		if ($id != NULL) {
			$this->db->where('sub_categories_id', $id);
		}

		$this->db->join('categories', 'categories.categories_id = sub_categories.categories_id', 'LEFT');

		$post = $this->db->get();
		return $post;
	}

	public function get_sub_categories($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('sub_categories');

		if ($id != NULL) {
			$this->db->where('categories_id', $id);
		}

		$post = $this->db->get();
		return $post;
	}

	public function add($post)
	{
		$params['name_sub_categories']   	= $post['name_sub_categories'];
		$params['categories_id']   			= $post['categories_id'];
		$params['user_created']		 		= $this->session->userdata('user_id');

		$this->db->insert('sub_categories', $params);
	}

	public function edit($post)
	{

		$params['name_sub_categories']   	= $post['name_sub_categories'];
		$params['categories_id']   			= $post['categories_id'];
		$params['updated']              	= date('Y-m-d H:i:s');
		$params['user_updated']		 		= $this->session->userdata('user_id');


		$this->db->where('sub_categories_id', $post['sub_categories_id']);
		$this->db->update('sub_categories', $params);
	}

	public function del($post)
	{
		$this->db->where('sub_categories_id', $post);
		$this->db->delete('sub_categories');
	}
}
