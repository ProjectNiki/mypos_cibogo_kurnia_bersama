<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Bangkok");
class Categories_m extends CI_Model
{
	public function get($id = NULL)
	{
		$this->db->select('*');
		$this->db->from('categories');
		if ($id != NULL) {
			$this->db->where('categories_id', $id);
		}
		$post = $this->db->get();
		return $post;
	}

	public function add($post)
	{
		$params['name_categories']   = $post['name_categories'];
		$params['user_created']		 = $this->session->userdata('user_id');

		$this->db->insert('categories', $params);
	}


	public function edit($post)
	{
		$params['name_categories']      = $post['name_categories'];
		$params['updated']              = date('Y-m-d H:i:s');
		$params['user_updated']		 	= $this->session->userdata('user_id');


		$this->db->where('categories_id', $post['categories_id']);
		$this->db->update('categories', $params);
	}

	public function del($post)
	{
		$this->db->where('categories_id', $post);
		$this->db->delete('categories');
	}
}
