<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		$this->load->model('Transaction_model', 'transaction');
	}

	public function index()
	{ }

	public function detail()
	{ }

	public function confirm()
	{ }

	public function delete()
	{ }
}
