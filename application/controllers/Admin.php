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
		$this->load->model('Transaction_model', 'transaction');
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
		$data['item_categories'] = $this->item->getItemCategories();

		$this->form_validation->set_rules('item_name', 'Item Name', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('item_category', 'Item Category', 'required');
		$this->form_validation->set_rules('price', 'Item Price', 'required|numeric|trim');
		$this->form_validation->set_rules('stock', 'Item Stock', 'required|numeric|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/admin_header', $data);
			$this->load->view('layouts/admin_sidebar', $data);
			$this->load->view('layouts/admin_topbar', $data);
			$this->load->view('admin/items', $data);
			$this->load->view('layouts/admin_footer');
		} else {
			$fragile = $this->input->post('fragile');
			$fragile = $fragile !== NULL ? 1 : 0;
			$data = [
				'category_id' => $this->input->post('item_category'),
				'name' => $this->input->post('item_name'),
				'price' => $this->input->post('price'),
				'stock' => $this->input->post('stock'),
				'is_broken' => $fragile,
				'created_at' => time(),
				'deleted_at' => 0
			];

			if ($this->item->insertItem($data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>add</strong> menu</div>');
				redirect('admin/items');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed <strong>add</strong> menu</div>');
				redirect('admin/items');
			}
		}
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
		$data['title'] = "User List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['users'] = $this->user->getDataUsers();
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function logs()
	{
		$data['title'] = "Auctions List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/logs', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function transactions()
	{
		$data['title'] = "Transactions List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['transactions'] = $this->transaction->getTransactions();
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/transactions', $data);
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

	public function roles()
	{
		$data['title'] = "User Roles";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/roles', $data);
		$this->load->view('layouts/admin_footer');
	}
}
