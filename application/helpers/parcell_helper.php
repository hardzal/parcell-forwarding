<?php

function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('auth');
	} else {
		$role_id = $ci->session->userdata('role_id');
		$uri = $ci->uri->segment(1);

		if ($role_id == 2 && $uri == "admin") redirect('auth/blocked');
	}
}

function status_item($status)
{
	if ($status == 0) {
		return '<span class="badge badge-danger">Not Verified</span>';
	} else {
		return '<span class="badge badge-success">Not Verified</span>';
	}
}

function is_checked($check)
{
	if ($check) return "checked";
}

function is_expired($user_item_id)
{
	$ci = &get_instance();

	$transaction = $ci->db->get_where('user_items', ['id' => $user_item_id])->row_array();

	if ($transaction['deleted_at'] < time()) {
		return false;
	}

	return true;
}

function is_verified($user_item_id)
{
	$ci = &get_instance();

	$transaction = $ci->db->get_where('user_transactions', ['user_item_id' => $user_item_id]);
	$data = $transaction->row_array();

	if ($transaction->num_rows() < 1) {
		if (is_expired($user_item_id)) {
			return '<a href="' . base_url('item/verify/') . $user_item_id . '" class="badge badge-warning mr-2 verifyDataItem" data-toggle="modal" data-target="#modalItem" data-id="' . $user_item_id . '">Verify</a>';
		}
		return '<a href="#" class="badge badge-dark mr-2">Expired</a>';
	} else {
		if ($data['status'] == 0) {
			return '<a href="#" class="badge badge-secondary mr-2">Waiting</a>';
		} else {
			return '<a href="#" class="badge badge-success mr-2">Progress</a>';
		}
	}
}

function is_confirmed($user_item_id)
{
	$ci = &get_instance();

	$transaction = $ci->db->get_where('user_transactions', ['user_item_id' => $user_item_id]);

	if ($transaction->num_rows() < 1) {
		if (is_expired($user_item_id)) {
			return '<a href="' . base_url('transaction/wait/') . $user_item_id . '" class="badge badge-secondary mr-2 waitingTransaction" data-toggle="modal" data-target="#modalTransaction" data-id="' . $user_item_id . '">Waiting</a>';
		}
		return '<a href="#" class="badge badge-dark mr-2">Expired</a>';
	} else {
		$data = $transaction->row_array();
		if ($data['status'] == 0) {
			return '<a href="' . base_url('transaction/confirm/') . $user_item_id . '" class="badge badge-info mr-2 confirmationTransaction" data-toggle="modal" data-target="#modalTransaction" data-id="' . $user_item_id . '">Confirmed</a>';
		} else {
			return '<a href="' . base_url('transaction/progress/') . $user_item_id . '" class="badge badge-success mr-2 progressTransaction" data-toggle="modal" data-target="#modalTransaction" data-id="' . $user_item_id . '">Progress</a>';
		}
	}
}
