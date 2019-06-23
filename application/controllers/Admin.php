<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('layouts/admin_header');
		$this->load->view('layouts/admin_sidebar');
		$this->load->view('layouts/admin_topbar');
		$this->load->view('admin/index');
		$this->load->view('layouts/admin_footer');
	}
}
