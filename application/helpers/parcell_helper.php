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

function is_checked($check)
{
	if ($check) return "checked";
}

function is_expired($user_item_id)
{
	$ci = &get_instance();

	$transaction = $ci->db->get_where('user_items', ['id' => $user_item_id])->row_array();

	if ($transaction['deleted_at'] < time()) {
		// price auction 
		$price = $transaction['cost'] * 0.5;

		$auction = [
			'item_id' => $transaction['item_id'],
			'price' => $price,
			'stock' => $transaction['total'],
			'status' => 1,
			'created_at' => time(),
			'deleted_at' => time()
		];

		$ci->db->insert('item_auctions', $auction);

		$ci->db->delete('user_items', ['id' => $user_item_id]);

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
			return '<a href="' . base_url('item/verify/') . $user_item_id . '" class="badge badge-primary mr-2 verifyDataItem" data-toggle="modal" data-target="#modalItem" data-id="' . $user_item_id . '">Detail</a>';
		}
		return '<a href="#" class="badge badge-secondary mr-2">Expired</a>';
	} else {
		if ($data['status'] == 0) {
			return '<a href="' . base_url('item/wait/') . $user_item_id . '" class="badge badge-primary mr-2 waitDataItem"  data-toggle="modal" data-target="#modalItem" data-id="' . $user_item_id . '">Detail</a>';
		} else {
			return '<a href="' . base_url('item/confirm/') . $user_item_id . '" class="badge badge-primary mr-2 progressDataItem"  data-toggle="modal" data-target="#modalItem" data-id="' . $user_item_id . '">Detail</a>';
		}
	}
}

function is_confirmed($user_item_id)
{
	$ci = &get_instance();

	$transaction = $ci->db->get_where('user_transactions', ['user_item_id' => $user_item_id]);

	if ($transaction->num_rows() < 1) {
		if (is_expired($user_item_id)) {
			return '<a href="' . base_url('transaction/wait/') . $user_item_id . '" class="badge badge-primary mr-2 waitingTransaction" data-toggle="modal" data-target="#modalTransaction" data-id="' . $user_item_id . '">Detail</a>';
		}
		return '<a href="#" class="badge badge-secondary mr-2">Expired</a>';
	} else {
		$data = $transaction->row_array();
		if ($data['status'] == 0) {
			return '<a href="' . base_url('transaction/confirm/') . $user_item_id . '" class="badge badge-primary mr-2 confirmationTransaction" data-toggle="modal" data-target="#modalTransaction" data-id="' . $user_item_id . '">Detail</a>';
		} else {
			return '<a href="' . base_url('transaction/progress/') . $user_item_id . '" class="badge badge-primary mr-2 progressTransaction" data-toggle="modal" data-target="#modalTransaction" data-id="' . $user_item_id . '">Detail</a>';
		}
	}
}

function status_item($user_item_id, $role_id)
{
	$ci = &get_instance();

	$transaction = $ci->db->get_where('user_transactions', ['user_item_id' => $user_item_id])->row_array();
	$user_item = $ci->db->get_where('user_items', ['id' => $user_item_id])->row_array();

	if ($role_id == 1) {
		if ($transaction == NULL) {
			return '<span class="badge badge-warning">Waiting</span>';
		} else {
			if ($transaction['status'] == 0) {
				return '<span class="badge badge-secondary">Confirmation</span>';
			} else if ($user_item['status'] == 0) {
				return '<span class="badge badge-info">Progress</span>';
			} else {
				return '<span class="badge badge-success">Done</span>';
			}
		}
	} else if ($role_id == 2) {
		if ($transaction == NULL) {
			return '<span class="badge badge-warning">Verify</span>';
		} else {
			if ($transaction['status'] == 0) {
				return '<span class="badge badge-secondary">Waiting</span>';
			} else  if ($user_item['status'] == 0) {
				return '<span class="badge badge-info">Progress</span>';
			} else {
				return '<span class="badge badge-success">Done</span>';
			}
		}
	}
}
