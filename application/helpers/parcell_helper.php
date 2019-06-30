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
