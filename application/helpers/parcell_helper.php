<?php

function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('auth');
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
