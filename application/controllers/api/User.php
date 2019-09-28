<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once("application/core/MY_RESTController.php");

class User extends MY_RESTController
{
	public function __construct()
	{
		parent::__construct();
		$this->validateAuth();
		$this->load->model('user_model');
	}

	public function index()
	{
		$users = $this->user_model->all();
		return $this->response(['data' => $users]);
	}
}
