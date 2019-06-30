<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auction_model', 'auction');
	}
	public function index()
	{
		$data['title'] = "Auction list";

		$this->load->view('layouts/header', $data);
		$this->load->view('auction/index', $data);
		$this->load->view('layouts/footer');
	}
}
