<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_model', 'user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = "Dashboard Admin";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function items()
	{
		$data['title'] = "Items List";
	}

	public function auctions()
	{ }

	public function users()
	{ }
}
