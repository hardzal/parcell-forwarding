<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item_model', 'item');
	}

	public function index()
	{ }

	public function edit()
	{ }

	public function delete()
	{ }
}
