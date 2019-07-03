<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Auth_model', 'auth');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$data['title'] = "Login Page";

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('layouts/auth_footer');
		} else {
			$this->_loginProcess();
		}
	}

	public function login()
	{
		redirect('auth');
	}

	private function _loginProcess()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		$user = $this->auth->getUser($email);

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'user_id' 	=> $user['id'],
						'email' 	=> $user['email'],
						'role_id' 	=> $user['role_id']
					];

					$this->session->set_userdata($data);

					if ($data['role_id'] == 1) {
						redirect('admin');
					} else if ($data['role_id'] == 2) {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger">Wrong password!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">This email has not been activated!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">This email not registered!</div>');
			redirect('auth');
		}
	}

	public function signup()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$data['title'] = "Sign Up";

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
			'is_unique' => 'This email has been registered'
		]);

		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[confirm_password]', [
			'min_length' => "Password too short!",
			'matches' => "Password not same"
		]);

		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', [
			'matches' => "Password not same"
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/auth_header', $data);
			$this->load->view('auth/signup');
			$this->load->view('layouts/auth_footer');
		} else {
			$token = $this->auth->insertToken();

			if (!$token) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed created token. Please contact admin!</div>');
				redirect('auth');
			}

			if ($this->auth->insertDataUser()) {

				$user = $this->auth->getToken($token);

				$this->_sendEmail($user['token'], 'verify');

				$this->session->set_flashdata('message', '<div class="alert alert-success">Congratulation! your account has been created. Please activate your account!</div>');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed registered accound. Please contact admin!</div>');
				redirect('auth');
			}
		}
	}

	public function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'langkahkita01@gmail.com',
			'smtp_pass' => 'qwerty1070',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' 	=> 'utf-8',
			'newline' 	=> "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('langkahkita01@gmail.com', 'PF Admin');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {
			$this->email->subject('Account Verification | PF Admin');
			$this->email->message('Click this link to verify your account : <a href="' . base_url('auth/verify?email=') . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password | FP Admin');
			$this->email->message('Click this link to reset your password account : <a href="' . base_url('auth/resetpassword?email=') . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->auth->getUser($email);

		if ($user) {
			$user_token = $this->auth->getToken($token);

			if ($user_token) {
				if (time() - $user_token['created_at'] < (60 * 60 * 24)) {
					$this->auth->activatedUser($email);
					$this->auth->deleteToken($email);

					$this->session->set_userdata('verified_email', $email);
					$this->session->set_flashdata('message', '<div class="alert alert-success">Congratulation! your account has been created ' . $email . ' has been activated. Please Insert User details!</div>');
					redirect('auth/userdetail');
				} else {
					$this->auth->deleteUser($email);
					$this->auth->deleteToken($email);

					$this->session->set_flashdata('message', '<div class="alert alert-danger">Account activation failed! Token Expired!</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Account activation failed! Token failed!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Account activation failed! Email not registered!</div>');
			redirect('auth');
		}
	}


	public function userDetail()
	{
		if (!$this->session->userdata('verified_email')) {
			redirect('auth');
		}

		$user = $this->auth->getUser($this->session->userdata('verified_email'));
		$data['title'] = "User Details";
		$data['states'] = $this->db->get('countries')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|numeric|max_length[12]');
		$this->form_validation->set_rules('birth_date', 'Birth date', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('avatar', 'Avatar', 'trim');
		$this->form_validation->set_rules('city', 'City or District', 'required|trim');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('postcode', 'Post Code', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/auth_header', $data);
			$this->load->view('auth/user-detail', $data);
			$this->load->view('layouts/auth_footer');
		} else {
			$this->session->unset_userdata('verified_email');

			$name = $this->input->post('name');
			$gender = $this->input->post('gender');
			$phone_number = $this->input->post('phone_number');
			$birth_date = $this->input->post('birth_date');

			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$postcode = $this->input->post('postcode');

			$image_name = $_FILES['avatar']['name'];
			if ($image_name) {
				$config['allowed_types'] = "gif|jpg|png";
				$config['max_sizes'] = 2048;
				$config['upload_path'] = "./assets/img/profile/";

				$this->load->library('upload', $config);

				$this->upload->do_upload('avatar');
				$new_image = $this->upload->data('file_name');
			} else {
				$new_image = 'default.jpg';
			}

			$user_details = [
				'user_id' => $user['id'],
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

			if ($this->auth->insertUserDetail($user_details)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Congratulation! your account has been created ' . $user['email'] . ' has been activated. Please Login!</div>');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed to insert data user. Please contact admin!</div>');
				redirect('auth');
			}
		}
	}

	public function forgotPassword()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$data['title'] = "Forgot Password";

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layouts/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('layouts/auth_footer');
		} else {
			$email = $this->input->post('email', true);

			if ($this->auth->checkActiveEmail($email)) {

				$token = $this->auth->insertToken();

				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success">Please check your email to reset your password.</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Email is not registered or activated</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->auth->getUser($email);

		if ($user) {
			$user_token = $this->auth->getToken($token);

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Reset password failed! Token invalid.</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Reset password failed!. Wrong email.');
			redirect('auth');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$data['title'] = "Change Password";
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|matches[password]');

		if ($this->form_validation->run() ==  FALSE) {
			$this->load->view('layouts/auth_header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('layouts/auth_footer');
		} else {
			$password = password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			if ($this->auth->changePassword($password, $email)) {
				$this->session->unset_userdata('reset_email');
				$this->session->set_flashdata('message', '<div class="alert alert-success">Password has been changed!. Please login</div>');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed change password!. Please contact admin</div>');
				redirect('auth');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-primary" >You\'ve been logout</a></div>');
		redirect('auth');
	}

	public function blocked()
	{
		$data['title'] = "403 Access Blocked";
		$this->load->view('layouts/header', $data);
		$this->load->view('auth/blocked', $data);
		$this->load->view('layouts/footer');
	}
}
