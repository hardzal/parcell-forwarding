<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_model', 'user');
		$this->load->model('Item_model', 'item');
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
		$data['items'] = $this->item->getItems();
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/items', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function auctions()
	{
		$data['title'] = "Auctions List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/auctions', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function users()
	{
		$data['title'] = "Auctions List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/auctions', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function logs()
	{
		$data['title'] = "Auctions List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/auctions', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function settings()
	{
		$data['title'] = "Settings";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/settings', $data);
		$this->load->view('layouts/admin_footer');
	}
}
