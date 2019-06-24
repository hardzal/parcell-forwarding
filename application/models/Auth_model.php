<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	public function insertDataUser()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		$data = [
			'role_id' 		=> 2,
			'email' 		=> htmlspecialchars($email),
			'password' 		=> password_hash($password, PASSWORD_DEFAULT),
			'is_active' 	=> 0,
			'created_at' 	=> time()
		];

		$this->db->insert('users', $data);
		return $this->db->affected_rows();
	}

	public function getUser($email)
	{
		return $this->db->get_where('users', ['email' => $email])->row_array();
	}

	public function insertToken()
	{
		$email = $this->input->post('email', true);

		$token = base64_encode(random_bytes(32));
		$user_token = [
			'email' => $email,
			'token' => $token,
			'created_at' => time()
		];

		$this->db->insert('user_token', $user_token);

		return $token;
	}

	public function getToken($token)
	{
		return $this->db->get_where('user_token', ['token' => $token])->row_array();
	}

	public function deleteUser($email)
	{
		$this->db->delete('users', ['email' => $email]);
		return $this->db->affected_rows();
	}

	public function deleteToken($email)
	{
		$this->db->delete('user_token', ['email' => $email]);
		return $this->db->affected_rows();
	}

	public function activatedUser($email)
	{
		$this->db->set('is_active', 1);
		$this->db->where('email', $email);
		$this->db->update('users');

		return $this->db->affected_rows();
	}

	public function checkActiveEmail($email)
	{
		$user = $this->db->get_where('users', [
			'email' => $email,
			'is_active' => 1
		])->row_array();

		return $user;
	}

	public function changePassword($password, $email)
	{
		$this->db->set('password', $password);
		$this->db->where('email', $email);
		$this->db->update('users');

		return $this->db->affected_rows();
	}

	public function insertUserDetail($user_details)
	{
		$this->db->insert('user_details', $user_details);
		return $this->db->affected_rows();
	}
}
