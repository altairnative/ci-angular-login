<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller
{
	public function index()
	{
		$data['content'] = 'login';
		$this->load->view('includes/template', $data);
	}
}

