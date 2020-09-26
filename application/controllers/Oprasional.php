<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oprasional extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
	}

	public function index()
	{
		$this->template->load('v_template', 'transaksi/oprasional/v_oprasional');
	}

	public function add()
	{
		$this->template->load('v_template', 'transaksi/oprasional/v_oprasional_add');
	}
}
