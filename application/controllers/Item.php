<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('Item_model', 'item');
		$this->load->model('User_model', 'user');
		$this->load->model('Transaction_model', 'transaction');
	}

	public function index()
	{ }

	public function edit()
	{
		$this->form_validation->set_rules('item_name', 'Item Name', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('item_category', 'Item Category', 'required');
		$this->form_validation->set_rules('price', 'Item Price', 'required|numeric|trim');
		$this->form_validation->set_rules('stock', 'Item Stock', 'required|numeric|trim');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->item->getItem($this->input->post('id')));
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
			$id = $this->input->post('id');
			if ($this->item->updateItem($id, $data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>updating</strong> item</div>');
				redirect('admin/items');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed <strong>updating</strong> item</div>');
				redirect('admin/items');
			}
		}
	}

	public function delete($id)
	{
		$this->transaction->deleteTransaction($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Successful deleting item</div>');
		redirect('admin/items');
	}

	public function verify()
	{
		$this->form_validation->set_rules('image', 'Image', 'trim');
		$this->form_validation->set_rules('user_item_id', 'User Items Id', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->item->getUserItems($this->input->post('id')));
		} else {
			$user_item_id = $this->input->post('user_item_id');
			$image = $_FILES['image']['name'];
			if ($image) {
				print_r($_FILES);
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_sizes'] = 2048;
				$config['upload_path'] = "./assets/img/screenshot/";

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$image = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->upload->display_errors() . "</div>");
					redirect('user/items');
				}

				$data = [
					'user_item_id' => $user_item_id,
					'image' => $image,
					'status' => 0,
					'created_at' => time()
				];

				if ($this->transaction->insertTransaction($data)) {
					$this->session->set_flashdata('message', '<div class="alert alert-success">Successful send verified transaction item. Please wait to update</div>');
					redirect('user/items');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed send verified transaction item</div>');
					redirect('user/items');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed upload image verified transaction item</div>');
				redirect('user/items');
			}
		}
	}

	public function detail()
	{ }
}
