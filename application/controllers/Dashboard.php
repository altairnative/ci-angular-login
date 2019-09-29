<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
        $data['content'] = 'dashboard/index';
		$this->load->view('includes/template', $data);
    }

    public function users()
    {
        $data['content'] = 'dashboard/user';
        $this->load->view('includes/template', $data);
    }
}
