<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	function __construct()
	{
		date_default_timezone_set("Asia/Bangkok");
		parent::__construct();
		$this->load->library('form_validation');
	}


	public function index()
	{
		$email		= $this->input->post('email');
		$pswd		= $this->input->post('password');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			check_already_login();

			$this->load->view('v_login');
		} else {
			$data = $this->db->get_where('user', array('email' => $email))->row_array();

			if ($data != NULL) {
				if ($data['is_active'] == 1) {
					if ($data['is_active'] == 2) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Akun anda terblokir, harap konfirmasi ke admin</div>');
						redirect('Auth');
					} else {
						if (password_verify($pswd, $data['password'])) {
							$data = [
								'user_id' 	=> $data['user_id'],
								'level'		=> $data['level']
							];

							$this->session->set_userdata($data);

							$params['in']  = date('Y-m-d H:i:s');
							$params['ip']  = $this->input->ip_address();

							$this->db->where('user_id', $data['user_id']);
							$this->db->update('user', $params);


							redirect('Dashboard');
						} else {
							$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Kata sandi anda salah</div>');
							redirect('Auth');
						}
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Akun anda tidak aktif, harap konfirmasi ke Admin</div>');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><strong>Error!</strong> Data tidak ditemukan</div>');
				redirect('Auth');
			}
		}
	}

	public function logout()
	{
		$data = array('user_id', 'level');

		$params['log']  = date('Y-m-d H:i:s');

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->update('user', $params);

		$this->session->unset_userdata($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>Success!</strong> Akun anda telah logout</div>');
		redirect('Auth');
	}
}
