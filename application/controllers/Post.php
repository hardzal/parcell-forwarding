<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = "Blog | Parcell-Forwarding";
		$data['posts'] = $this->db->get('posts')->result_array();

		$this->load->view('layouts/header', $data);
		$this->load->view('posts/index', $data);
		$this->load->view('layouts/footer');
	}

	public function edit()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('description', 'Description', 'required|trim|min_length[4]');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode($this->db->get_where('posts', ['id' => $this->input->post('id')])->row_array());
		} else {
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$post_id = $this->input->post('post_id');

			$image_name = $_FILES['image']['name'];
			if ($image_name) {
				$config['allowed_types'] = "gif|jpg|jpeg|png";
				$config['max_size'] = 2048;
				$config['upload_path'] = "./assets/img/posts/";

				$this->load->library('upload', $config);

				$this->upload->do_upload('image');
				$new_image = $this->upload->data('file_name');
				$this->db->set('image', $new_image);
			}

			$this->db->set('title', $title);
			$this->db->set('description', $description);
			$this->db->where('id', $post_id);
			$this->db->update('posts');

			if ($this->db->affected_rows()) {
				$this->session->set_flashdata('message', '<div class="alert alert-success">Successful <strong>update</strong> post</div>');
				redirect('admin/posts');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Failed <strong>update</strong> post</div>');
				redirect('admin/posts');
			}
		}
	}

	public function delete($id)
	{
		$this->db->delete('posts', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success">Successful deleting posts</div>');
		redirect('admin/posts');
	}
}
