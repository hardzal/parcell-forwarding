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
			$email = $this->input->post('email');

			$item_code = base64_encode(random_bytes(8));
		}
	}
}
