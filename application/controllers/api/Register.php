<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once("application/core/MY_RESTController.php");

class Register extends MY_RESTController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function store()
	{
		$this->form_validation->set_rules('firstName', 'First Name', 'required|max_length[50]');
		$this->form_validation->set_rules('lastName', 'Last Name', 'required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE) {
			return $this->response(['errors' => $this->validation_errors_array()], 422);
		}

		$user = $this->user_model->create([
			'first_name' => $this->input->post('firstName'),
			'last_name' => $this->input->post('lastName'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
		]);

		return $this->response([
			'message' => 'Registered successfully.',
			'data' => $user
		], 201);
	}
}
