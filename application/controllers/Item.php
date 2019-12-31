<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Mpdf\Mpdf;

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
	{
	}

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
		$this->item->deleteItem($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Successful deleting item</div>');
		redirect('admin/items');
	}

	public function verify()
	{
		// $this->form_validation->set_rules('image', 'Image', 'trim');
		$this->form_validation->set_rules('user_item_id', 'User Items Id', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->item->getUserItem($this->input->post('id')));
		} else {
			$user_item_id = $this->input->post('user_item_id');
			$image = $_FILES['image']['name'];
			if ($image) {
				print_r($_FILES);
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_size'] = 2048;
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

	public function confirm()
	{
		$this->form_validation->set_rules('user_item_id', 'User Item Id', 'required|numeric|trim');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->item->getUserItem($this->input->post('id')));
		} else {
			$user_item_id = $this->input->post('user_item_id');
			$status = $this->input->post('status');

			if ($this->user->updateUserItems(['status' => $status], ['id' => $user_item_id])) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful confirmed item.</div>');
				redirect('user/items');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-failed">failed confirmed item.</div>');
				redirect('user/items');
			}
		}
	}

	public function detail()
	{
	}

	public function report($id = null)
	{
		$data['bulk_status'] = 0;
		$user = $this->user->getUserDetail($this->session->userdata('user_id'));
		if ($id != null) {
			$item = $this->item->getUserItem($id);

			$data['item'] = [
				'item_code' => $item['item_code'],
				'item_name' => $item['item_name'],
				'item_category' => $item['category_name'],
				'email' => $this->session->userdata('email'),
				'name' => $user['name'],
				'phone_number' => $user['phone_number'],
				'address' => $item['address_to'],
				'weight' => $item['weight'],
				'item_price' => $item['cost_price'],
				'delivery_cost' => $item['cost_delivery'],
				'tax_cost' => $item['cost_tax'],
				'total_cost' => $item['cost_total'],
				'created_at' => $item['created_at'],
				'deadline_at' => $item['deleted_at']
			];
			$pdf = new Mpdf();
			$html = $this->load->view('items/report', $data, true);
			$pdf->SetDisplayMode('fullpage');
			$pdf->WriteHTML($html);
			$pdf->output($data['item']['item_code'] . '_report.pdf', 'I');
		} else {
			$items = $this->item->getUserItems($user['user_id']);
			$data['items'] = array();
			$data['bulk_status'] = 1;

			$pdf = new Mpdf();
			$pdf->SetDisplayMode('fullpage');

			foreach ($items as $key => $item) {

				if ($key) {
					$pdf->AddPage();
				}

				array_push($data['items'], [
					'item_code' => $item['item_code'],
					'item_name' => $item['item_name'],
					'item_category' => $item['category_name'],
					'email' => $this->session->userdata('email'),
					'name' => $user['name'],
					'phone_number' => $user['phone_number'],
					'address' => $item['address_to'],
					'weight' => $item['weight'],
					'item_price' => $item['cost_price'],
					'delivery_cost' => $item['cost_delivery'],
					'tax_cost' => $item['cost_tax'],
					'total_cost' => $item['cost_total'],
					'created_at' => $item['created_at'],
					'deadline_at' => $item['deleted_at']
				]);

				$html = $this->load->view('items/report', $data, true);
				unset($data['items'][$key]);

				$pdf->WriteHTML($html);
			}

			$pdf->SetHTMLFooter("");
			$pdf->output('bulk_report.pdf', 'I');
		}
	}
}
