<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;

class Transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');
		$this->load->model('Item_model', 'item');
		$this->load->model('Transaction_model', 'transaction');
	}

	public function index()
	{
		redirect(base_url());
	}

	public function detail()
	{
		redirect(base_url());
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
		$data['bulk_status'] = 0;
		$user = $this->user->getUserDetail($this->session->userdata('user_id'));
		$pdf = new Mpdf();
		$pdf->SetDisplayMode('fullpage');

		if ($id != null) {
			$transaction = $this->transaction->getDetailTransaction($id);
			$data['item'] = [
				'item_code' => $transaction['item_code'],
				'item_name' => $transaction['item_name'],
				'item_category' => $transaction['category_name'],
				'email' => $this->session->userdata('email'),
				'name' => $user['name'],
				'phone_number' => $user['phone_number'],
				'address' => $transaction['address_to'],
				'weight' => $transaction['weight'],
				'item_price' => $transaction['cost_price'],
				'delivery_cost' => $transaction['cost_delivery'],
				'tax_cost' => $transaction['cost_tax'],
				'total_cost' => $transaction['cost_total'],
				'created_at' => $transaction['created_at'],
				'deadline_at' => $transaction['deleted_at']
			];
			$html = $this->load->view('transactions/report_i', $data, true);

			$pdf->WriteHTML($html);
			$pdf->SetHTMLFooter("");
			$pdf->output($user['name'] . '_bulk_report.pdf', 'I');
		} else {

			$data['bulk_status'] = 1;
			$data['items'] = array();

			if ($this->session->userdata('role_id') == 1) {
				$transactions = $this->transaction->getTransactions();
			} else {
				$transactions = $this->transaction->getTransactions($this->session->userdata('user_id'));
			}

			foreach ($transactions as $key => $transaction) {
				array_push($data['items'], [
					'item_code' => $transaction['item_code'],
					'item_name' => $transaction['item_name'],
					'item_category' => $transaction['category_name'],
					'email' => $this->session->userdata('email'),
					'name' => $user['name'],
					'phone_number' => $user['phone_number'],
					'item_total' => $transaction['total'],
					'weight' => $transaction['weight'],
					'item_price' => $transaction['cost_price'],
					'delivery_cost' => $transaction['cost_delivery'],
					'tax_cost' => $transaction['cost_tax'],
					'total_cost' => $transaction['cost_total']
				]);
			}
			$html = $this->load->view('transactions/report', $data, true);

			$pdf->WriteHTML($html);
			$pdf->SetHTMLFooter("");
			$pdf->output($user['name'] . '_bulk_report.pdf', 'I');
		}
	}
}
