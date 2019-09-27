<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends REST_Controller
{
	public function store()
	{
		return $this->response('ok', 200);
	}
}
