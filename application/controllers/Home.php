<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = "Home | Parcell-Forwarding";
		$this->load->view('layouts/header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('layouts/footer');
	}

	public function about()
	{
		$data['title'] = "About | Parcell-Forwarding";
		$data['content'] = $this->db->get_where('site_info', ['id' => 1])->row_array();
		
		$this->load->view('layouts/header', $data);
		$this->load->view('home/about', $data);
		$this->load->view('layouts/footer');
	}
}
