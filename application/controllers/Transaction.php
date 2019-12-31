<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;

class Transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');
		$this->load->model('Item_model', 'item');
		$this->load->model('Transaction_model', 'transaction');
	}

	public function index()
	{
	}

	public function detail()
	{
	}

	public function confirm()
	{
		$this->form_validation->set_rules('user_item_id', 'User Item Id', 'required|numeric|trim');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->transaction->getTransaction($this->input->post('id')));
		} else {
			$user_item_id = $this->input->post('user_item_id');
			$data = ['status' => 1];
			$where = ['user_item_id' => $user_item_id];
			if ($this->transaction->updateTransaction($where, $data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful confirmation user transaction</div>');
				redirect('admin/transactions');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">failed confirmation user transaction</div>');
				redirect('admin/transactions');
			}
		}
	}

	public function delete($id)
	{
		$this->db->delete('user_items', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Successful deleting item</div>');
		redirect('admin/transactions');
	}

	public function save()
	{
		$this->form_validation->set_rules('user_item_id', 'User Item Id', 'required|numeric|trim');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->item->getUserItems($this->input->post('id')));
		} else {
			$user_item_id = $this->input->post('user_item_id');
		}
	}

	public function report($id = null)
	{
		
	}
}
