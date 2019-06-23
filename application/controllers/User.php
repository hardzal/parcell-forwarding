<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('layouts/admin_header');
		$this->load->view('users/index');
		$this->load->view('layouts/admin_footer');
	}
}
