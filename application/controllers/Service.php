<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->library('form_validation');
		$this->load->model('User_model', 'user');
		$this->load->model('Item_model', 'item');
	}

	public function index()
	{
		$data['title'] = "Service Page";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['item_categories'] = $this->item->getItemCategories();
		$data['states'] = $this->db->get('countries')->result_array();
		$data['deliveries'] = $this->db->get('deliveries')->result_array();

		$this->form_validation->set_rules('item_name', 'Item Name', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('item_price', 'Item Price', 'required|trim|numeric');
		$this->form_validation->set_rules('item_total', 'Item Total', 'required|trim|numeric');
		$this->form_validation->set_rules('item_category', 'Item Category', 'required|trim');
		$this->form_validation->set_rules('address_from', 'Address From', 'required|trim');
		$this->form_validation->set_rules('address_to', 'Address To', 'required|trim');
		$this->form_validation->set_rules('country', 'Country', 'required|trim');
		$this->form_validation->set_rules('city', 'City', 'required|trim');
		$this->form_validation->set_rules('postcode', 'Postcode', 'required|numeric|trim|max_length[6]');
		$this->form_validation->set_rules('delivery', 'Delivery by', 'required');
		$this->form_validation->set_rules('weight', 'Weight', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/header', $data);
			$this->load->view('services/index', $data);
			$this->load->view('layouts/footer');
		} else {
			$item_name = $this->input->post('item_name');
			$item_price = $this->input->post('item_price');
			$item_total = $this->input->post('item_total');
			$item_category = $this->input->post('item_category');
			$address_from = $this->input->post('address_from');
			$address_to = $this->input->post('address_to');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$postcode = $this->input->post('postcode');
			$delivery_id = $this->input->post('delivery');
			$weight = $this->input->post('weight');
			$broken = $this->input->post('fragile');
			$description = $this->input->post('description');

			$item_code = base64_encode(random_bytes(8));

			$item_data = [
				'category_id' 	=> $item_category,
				'name' 			=> $item_name,
				'price' 		=> $item_price,
				'stock'			=> $item_total,
				'is_broken'		=> $broken,
				'created_at'	=> time(),
				'deleted_at'	=> 0
			];

			if ($this->item->insertItem($item_data)) {
				$new_item = $this->item->getItemByName($item_name);
				$delivery = $this->db->get_where('deliveries', ['id' => $delivery_id])->row_array();
				$user_id = $data['user']['id'];

				// bea masuk 7,5%
				$bea_masuk = $item_price * 0.075;
				// ppn 10%
				$ppn = $item_price * 0.1;
				// pph 10%
				$pph = $item_price * 0.1;

				$tax = $bea_masuk + $ppn + $pph;

				if ($country == 3) {
					$cost = $item_price;
				} else {
					$cost = $item_price + $tax;
				}

				if ($weight == 1) {
					$cost += $delivery['cost_weight'];
				} else {
					$cost += ($weight * $delivery['cost_weight']);
				}

				$user_item = [
					'user_id' => $user_id,
					'item_id' => $new_item['id'],
					'delivery_id' => $delivery_id,
					'item_code' => $item_code,
					'total' => $item_total,
					'cost' => $cost,
					'address_to' => $address_to,
					'address_from' => $address_from,
					'country_id' => $country,
					'city' => $city,
					'postcode' => $postcode,
					'description' => $description,
					'status' => 0,
					'created_at' => time(),
					'deleted_at' => 0
				];
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Error when inserting data</div>');
				redirect('user');
			}
		}
	}
}
