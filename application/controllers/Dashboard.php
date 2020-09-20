<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		// $this->load->model(['dashboard_m']);
	}

	public function index()
	{
		$this->template->load('v_template', 'v_dashboard');
	}
}
