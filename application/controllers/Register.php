<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function index()
	{
        $data['content'] = 'register';
		$this->load->view('includes/template', $data);
	}
}
