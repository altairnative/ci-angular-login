<?php

use Firebase\JWT\JWT;

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_RESTController extends CI_Controller
{
    private $headers;

	public function __construct()
	{
        parent::__construct();
        $this->headers = $this->input->request_headers();
		$this->config->load('jwt');
		$this->load->library('form_validation');
	}

	public function response(array $data = [], int $statusCode = 200)
	{
		return $this->output
			->set_content_type('application/json')
			->set_status_header($statusCode)
			->set_output(json_encode(array_merge(array('status_code' => $statusCode), $data)));
	}

	public function validation_errors_array(string $prefix = '', string $suffix = '') {
		if (FALSE === ($OBJ = & _get_validation_object())) {
			return '';
		}

		return $OBJ->error_array($prefix, $suffix);
	}

	public function show_json_error($message, $status_code = 500, $status_message = '')
	{
		header('Cache-Control: no-cache, must-revalidate');
		header('Content-type: application/json');
		set_status_header($status_code, $status_message);

		echo json_encode([
			'status_code' => $status_code,
			'message' => $message
		]);

		exit;
    }

    public function getAuthUser()
    {
        list($token) = sscanf( $this->headers['Authorization'], 'Bearer %s');
        $decodedJson = JWT::decode(
            $token,
            $this->config->item('secret_key'),
            $this->config->item('algorithm')
        );

        return $decodedJson->data;
    }

	public function validateAuth()
	{
		if (!isset($this->headers['Authorization'])) {
			$this->show_json_error('Unauthenticated.', 401);
		}

		list($token) = sscanf( $this->headers['Authorization'], 'Bearer %s');
		if (!$token) {
			$this->show_json_error('Bad Request on bearer token.', 400);
		}

		try {
			return JWT::decode(
				$token,
				$this->config->item('secret_key'),
				$this->config->item('algorithm')
			);

		} catch (Exception $e) {
			$this->show_json_error($e->getMessage(), 401);
		}

		exit();
	}
}
