<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;

require_once("application/core/MY_RESTController.php");

class Login extends MY_RESTController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function authenticate()
	{
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE) {
			return $this->response(['errors' => $this->validation_errors_array()], 422);
		}

		$user = $this->user_model->getWhere(array('email' => $this->input->post('email')));
		if (empty($user) || !password_verify($this->input->post('password'), $user[0]->password)) {
			return $this->response(['message' => 'Email/Password is incorrect.'], 404);
		}

		$token = JWT::encode([
			'iss' => base_url(),
			'aud' => base_url(),
			'iat' => time(),
			'nbf' => time(),
			'exp' => time() + 86400,
			'data' => [
				'id' => $user[0]->id,
				'firstName' => $user[0]->first_name,
				'lastName' => $user[0]->last_name,
				'email' => $user[0]->email,
			],
		], $this->config->item('secret_key'));

		return $this->response(['token' => $token]);
	}
}

