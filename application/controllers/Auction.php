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
				'created_at' 	=> time()
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
}
