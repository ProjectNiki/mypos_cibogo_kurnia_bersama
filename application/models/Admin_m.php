<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{
	public function edit($post)
	{
		$params['nama']         = $post['nama'];
		$params['email']        = $post['email'];
		$params['alamat']       = $post['alamat'];

		if ($post['password'] != NULL) {
			$params['password']     = password_hash($post['password'], PASSWORD_DEFAULT);
		}

		$this->db->where('user_id', $post['user_id']);
		$this->db->update('user', $params);
	}
}
