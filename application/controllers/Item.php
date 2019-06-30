<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item_model', 'item');
		$this->load->library('form_validation');
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
		$this->db->delete('items', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Successful deleting item</div>');
		redirect('admin/items');
	}
}
