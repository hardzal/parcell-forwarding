<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_model', 'user');
		$this->load->model('Item_model', 'item');
		$this->load->model('Transaction_model', 'transaction');
		$this->load->model('Auction_model', 'auction');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = "Dashboard Admin";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['member'] = $this->user->getTotalUser();
		$data['transaksi'] = $this->transaction->getTotalTransaction();
		$data['pendapatan'] = $this->transaction->getTotalCost();
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function items()
	{

		if ($this->input->post('search')) {
			$data['keyword'] = $this->input->post('keyword');
			// $this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = null;
		}

		$this->db->like('items.name', $data['keyword']);
		$this->db->or_like('item_categories.name', $data['keyword']);
		$this->db->from('items');
		$this->db->join('item_categories', 'items.category_id = item_categories.id');

		// config
		$config['base_url'] = 'http://localhost/projects/parcell-forwarding/admin/items';
		$config['total_rows'] = $this->db->count_all_results();
		$config['per_page'] = 10;
		$data['result_total_rows'] = $config['total_rows'];
		// batas kanan kiri paginasi
		// $config['num_link'] = 3;

		// initialize
		$this->pagination->initialize($config);

		$data['title'] = "Items List";
		$data['start'] = $this->uri->segment(3) != null ? $this->uri->segment(3) : 0;
		$data['items'] = $this->item->getItems($config['per_page'], $data['start'], $data['keyword']);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>add</strong> item</div>');
				redirect('admin/items');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed <strong>add</strong> item</div>');
				redirect('admin/items');
			}
		}
	}

	public function auctions()
	{
		if ($this->input->post('search')) {
			$data['keyword'] = $this->input->post('keyword');
			// $this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = null;
		}

		$this->db->like('item_auctions.price', $data['keyword']);
		$this->db->or_like('items.name', $data['keyword']);
		$this->db->from('item_auctions');
		$this->db->join('items', 'item_auctions.item_id = items.id');

		// config
		$config['base_url'] = 'http://localhost/parcell-forwarding/admin/auctions';
		$config['total_rows'] = $this->db->count_all_results();
		$data['result_total_rows'] = $config['total_rows'];
		$config['per_page'] = 10;
		// batas kanan kiri paginasi
		// $config['num_link'] = 3 

		// initialize
		$this->pagination->initialize($config);

		$data['title'] = "Auctions List";
		$data['start'] = $this->uri->segment(3) != null ? $this->uri->segment(3) : 0;
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['auctions'] = $this->auction->getAuctions($config['per_page'], $data['start'], $data['keyword']);
		$data['item_categories'] = $this->item->getItemCategories();

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
		if ($this->input->post('search')) {
			$data['keyword'] = $this->input->post('keyword');
			// $this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = null;
		}

		$this->db->like('items.name', $data['keyword']);
		$this->db->or_like('user_items.item_code', $data['keyword']);
		$this->db->from('items');
		$this->db->join('user_items', 'items.id = user_items.item_id');

		// config
		$config['base_url'] = 'http://localhost/parcell-forwarding/admin/transactions';
		$config['total_rows'] = $this->db->count_all_results();
		$data['result_total_rows'] = $config['total_rows'];
		$config['per_page'] = 10;
		// batas kanan kiri paginasi
		// $config['num_link'] = 3 

		// initialize
		$this->pagination->initialize($config);

		$data['title'] = "Transactions List";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['start'] = $this->uri->segment(3) != null ? $this->uri->segment(3) : 0;
		$data['transactions'] = $this->transaction->getItemTransactions($config['per_page'], $data['start'], $data['keyword']);
		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('admin/transactions', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function posts()
	{
		$data['title'] = "Posts";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['posts'] = $this->db->get('posts')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('description', 'Description', 'required|trim|min_length[4]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/admin_header', $data);
			$this->load->view('layouts/admin_sidebar', $data);
			$this->load->view('layouts/admin_topbar', $data);
			$this->load->view('admin/posts', $data);
			$this->load->view('layouts/admin_footer');
		} else {
			$title = $this->input->post('title');
			$description = $this->input->post('description');

			$image_name = $_FILES['image']['name'];
			if ($image_name) {
				$config['allowed_types'] = "gif|jpg|jpeg|png";
				$config['max_sizes'] = 2048;
				$config['upload_path'] = "./assets/img/posts/";

				$this->load->library('upload', $config);

				$this->upload->do_upload('image');
				$new_image = $this->upload->data('file_name');
			}

			$post = [
				'title' => $title,
				'image' => $new_image,
				'description' => $description
			];

			$this->db->insert('posts', $post);
			if ($this->db->affected_rows()) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>add</strong> post</div>');
				redirect('admin/posts');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed <strong>delete</strong> post</div>');
				redirect('admin/posts');
			}
		}
	}

	public function settings()
	{
		$data['title'] = "Settings";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['content'] = $this->db->get('site_info')->result_array();

		$this->form_validation->set_rules('fb', 'Facebook', 'required|trim');
		$this->form_validation->set_rules('tw', 'Twitter', 'required|trim');
		$this->form_validation->set_rules('ig', 'Instagram', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('about', 'About', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/admin_header', $data);
			$this->load->view('layouts/admin_sidebar', $data);
			$this->load->view('layouts/admin_topbar', $data);
			$this->load->view('admin/settings', $data);
			$this->load->view('layouts/admin_footer');
		} else {
			$fb = $this->input->post('fb');
			$tw = $this->input->post('tw');
			$ig = $this->input->post('ig');
			$email = $this->input->post('email');
			$about = $this->input->post('about');

			$this->db->set('content', $fb);
			$this->db->where('id', 2);
			$this->db->update('site_info');

			$this->db->set('content', $tw);
			$this->db->where('id', 3);
			$this->db->update('site_info');

			$this->db->set('content', $ig);
			$this->db->where('id', 4);
			$this->db->update('site_info');

			$this->db->set('content', $email);
			$this->db->where('id', 5);
			$this->db->update('site_info');

			$this->db->set('content', $about);
			$this->db->where('id', 1);
			$this->db->update('site_info');

			$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>update</strong> site info</div>');
			redirect('admin/settings');
		}
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
