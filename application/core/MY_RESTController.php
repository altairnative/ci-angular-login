<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_RESTController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function formErrorResponse()
	{
		return $this->response(array(
			'errors' => $this->validation_errors_array(),
		), 422);
	}

	public function response(array $data = [], int $statusCode = 200)
	{
		return $this->output
			->set_content_type('application/json')
			->set_status_header($statusCode)
			->set_output(json_encode(array_merge(array('status_code' => $statusCode), $data)));
	}

	private function validation_errors_array(string $prefix = '', string $suffix = '') {
		if (FALSE === ($OBJ = & _get_validation_object())) {
			return '';
		}

		return $OBJ->error_array($prefix, $suffix);
	}
}
