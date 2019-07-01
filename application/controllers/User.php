<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
		$data['title'] = "Dashboard User";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));

		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('users/index', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function profile()
	{
		$data['title'] = "My Profile";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));

		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar', $data);
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('users/profile', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function editprofile()
	{
		$data['states'] = $this->db->get('countries')->result_array();

		$data['title'] = "Edit Profile";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric|max_length[12]');
		$this->form_validation->set_rules('birth_date', 'Birth date', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('avatar', 'Avatar', 'trim');
		$this->form_validation->set_rules('city', 'City or District', 'required|trim');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('postcode', 'Post Code', 'required|max_length[6]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/admin_header', $data);
			$this->load->view('layouts/admin_sidebar');
			$this->load->view('layouts/admin_topbar', $data);
			$this->load->view('users/change-profil', $data);
			$this->load->view('layouts/admin_footer');
		} else {
			$name = $this->input->post('name');
			$gender = $this->input->post('gender');
			$phone_number = $this->input->post('phone_number');
			$birth_date = $this->input->post('birth_date');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$postcode = $this->input->post('postcode');
			$user_id = $this->input->post('user_id');

			$image_name = $_FILES['avatar']['name'];
			if ($image_name) {
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_sizes'] = 2048;
				$config['upload_path'] = "./assets/img/profile/";

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('avatar')) {
					$old_image = $data['user']['avatar'];

					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_name');
				} else {
					$this->session->set_flashdata('message', "<div class='alert alert-danger'>" . $this->upload->display_errors() . "</div>");
					redirect('user/changepassword');
				}
			} else {
				$new_image = $data['user']['avatar'];
			}

			$user_details = [
				'user_id' => $user_id,
				'name' => $name,
				'phone_number' => $phone_number,
				'gender' => $gender,
				'birth_date' => $birth_date,
				'avatar' => $new_image,
				'address' => $address,
				'city' => $city,
				'country_id' => $state,
				'postcode' => $postcode
			];

			if ($this->user->updateUser($user_details, $user_id)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successfully updating your profile</div>');
				redirect('user');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed to update profile</div>');
				redirect('admin');
			}
		}
	}

	public function changepassword()
	{
		$data['title'] = "Change Password";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[6]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[new_password]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/admin_header', $data);
			$this->load->view('layouts/admin_sidebar');
			$this->load->view('layouts/admin_topbar', $data);
			$this->load->view('users/change-password', $data);
			$this->load->view('layouts/admin_footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');

			if (password_verify($current_password, $data['user']['password'])) {
				if ($current_password != $new_password) {
					$password = password_hash($new_password, PASSWORD_DEFAULT);
					$this->user->updatePasswordUser($password, $data['user']['email']);

					$this->session->set_flashdata('message', '<div class="alert alert-success">Successful change password</div>');
					redirect('user');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">The new password cannot be same as current password!</div>');
					redirect('user/changepassword');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Wrong current password</div>');
				redirect('user/changepassword');
			}
		}
	}

	public function items()
	{
		$data['title'] = "My Item list";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['items'] = $this->user->getUserItems($this->session->userdata('user_id'));

		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar');
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('users/items', $data);
		$this->load->view('layouts/admin_footer');
	}

	public function transactions()
	{
		$data['title'] = "My Transactions";
		$data['user'] = $this->user->getDataUser($this->session->userdata('email'));
		$data['transactions'] = $this->user->getUserTransactions($this->session->userdata('user_id'));

		$this->load->view('layouts/admin_header', $data);
		$this->load->view('layouts/admin_sidebar');
		$this->load->view('layouts/admin_topbar', $data);
		$this->load->view('users/transactions', $data);
		$this->load->view('layouts/admin_footer');
	}
}
