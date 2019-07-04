<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auction_model', 'auction');
		$this->load->model('User_model', 'user');
		$this->load->model('Item_model', 'item');
	}
	public function index()
	{
		$data['title'] = "Auction list";
		$data['auctions'] = $this->auction->getAuctions();

		$this->load->view('layouts/header', $data);
		$this->load->view('auction/index', $data);
		$this->load->view('layouts/footer');
	}

	public function view()
	{
		$this->form_validation->set_rules('auction_id', 'Auction Id', 'required|numeric|trim');
		$this->form_validation->set_rules('auction_price', 'Auction Price', 'required|numeric|trim');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->user->getUserAuctions($this->input->post('id')));
		} else {
			$auction_id = $this->input->post('auction_id');
			$auction_price = $this->input->post('auction_price');
			$user_id = $this->session->userdata('user_id');

			$data = [
				'auction_id' 	=> $auction_id,
				'user_id' 	 	=> $user_id,
				'price' 		=> $auction_price,
				'created_at' 	=> time(),
				'deleted_at' 	=> 0
			];

			if ($this->user->insertUserAuction($data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful binding auction.</div>');
				redirect('auction');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed binding auction.</div>');
				redirect('auction');
			}
		}
	}

	public function confirm()
	{
		$this->form_validation->set_rules('address_to', 'Address to', 'required|trim');
		$this->form_validation->set_rules('country', 'Country', 'required|trim');
		$this->form_validation->set_rules('city', 'City', 'required|trim');
		$this->form_validation->set_rules('postcode', 'Zip', 'required|trim|numeric');
		$this->form_validation->set_rules('delivery', 'Delivery', 'required');
		$this->form_validation->set_rules('weight', 'Weight', 'required|numeric|trim');
		$this->form_validation->set_rules('description', 'Description', 'trim');
		$this->form_validation->set_rules('stock', 'Stock', 'required|numeric|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric|trim');
		$this->form_validation->set_rules('user_id', 'User Id', 'required|numeric|trim');
		$this->form_validation->set_rules('item_id', 'Item Id', 'required|numeric|trim');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->user->getUserAuction($this->input->post('id')));
		} else {
			$address_to = $this->input->post('address_to');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$zip = $this->input->post('postcode');
			$delivery_id = $this->input->post('delivery');
			$weight = $this->input->post('weight');
			$description = $this->input->post('decsription');

			$item_id = $this->input->post('item_id');
			$user_id = $this->input->post('user_id');
			$price = $this->input->post('price');
			$stock = $this->input->post('stock');
			$item_code = substr(base64_encode(random_bytes(8)), 0, 6);

			$delivery = $this->db->get_where('deliveries', ['id' => $delivery_id])->row_array();
			$cost_delivery = 0;

			// bea masuk 7,5%
			$bea_masuk = $price * 0.075;
			// ppn 10%
			$ppn = $price * 0.1;
			// pph 10%
			$pph = $price * 0.1;

			$tax = $bea_masuk + $ppn + $pph;

			if ($country == 3) {
				$cost = $price;
				$tax = 0;
			} else {
				$cost = $price + $tax;
			}

			if ($weight <= 1) {
				$cost_delivery += $delivery['cost_weight'];
			} else {
				$cost_delivery += ($weight * $delivery['cost_weight']);
			}

			$cost = $cost + $cost_delivery;
			$cost = $cost * $stock;

			$user_item = [
				'user_id' => $user_id,
				'item_id' => $item_id,
				'delivery_id' => $delivery_id,
				'item_code' => $item_code,
				'total' => $stock,
				'cost' => $cost,
				'address_to' => $address_to,
				'address_from' => 'PF Placemant',
				'country_id' => $country,
				'city' => $city,
				'postcode' => $zip,
				'description' => $description,
				'status' => 0,
				'created_at' => time(),
				'deleted_at' => time() + 600 // buat mengubah waktu verifikasi transaksi
			];
			$item = $this->db->get_where('items', ['id' => $item_id])->row_array();
			$id = $this->input->post('auction_id');
			if ($this->item->insertUserItem($user_item)) {
				$this->db->delete('user_auctions', ['auction_id' => $id]);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful requesting item. click <a href="' . base_url('service/report') . '"><i class="fas fa-fw external-link-alt">here</i></a> to detail</div>');
				$category = $this->item->getItemCategory($item['category_id']);
				$user = $this->user->getUserDetail($this->session->userdata('user_id'));
				$this->session->set_userdata('report', [
					'item_code' => $item_code,
					'item_name' => $item['name'],
					'item_category' => $category['name'],
					'email' => $this->session->userdata('email'),
					'name' => $user['name'],
					'phone_number' => $user['phone_number'],
					'address' => $address_to,
					'item_price' => $price,
					'delivery_cost' => $cost_delivery,
					'tax_cost' => $tax,
					'total_cost' => $cost,
					'created_at' => time(),
					'deadline_at' => time() + 600
				]);

				redirect('user/auctions');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error when inserting data</div>');
				redirect('user/auctions');
			}
		}
	}

	public function edit()
	{
		$this->form_validation->set_rules('price', 'Item Price', 'required|numeric');
		$this->form_validation->set_rules('stock', 'Item Stock', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->auction->getAuction($this->input->post('id')));
		} else {
			$auction = $this->auction->getAuction($this->input->post('auction_id'));
			if ($this->input->post('status') == 1) {
				$deadline = time() + 300; // waktu mengaktifkan kembali auction
			} else {
				$deadline = $auction['deadline'];
			}
			$data = [
				'item_id' => $this->input->post('item_id'),
				'price' => $this->input->post('price'),
				'stock' => $this->input->post('stock'),
				'status' => $this->input->post('status'),
				'deleted_at' => $deadline
			];
			$id = $this->input->post('auction_id');
			if ($this->auction->updateAuction($data, ['id' => $id])) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>updating</strong> item</div>');
				redirect('admin/auctions');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed <strong>updating</strong> item</div>');
				redirect('admin/auctions');
			}
		}
	}

	public function delete($id)
	{
		$this->auction->deleteAuction($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>deleting</strong> item</div>');
		redirect('admin/auctions');
	}
}
