<?php

use Firebase\JWT\JWT;

defined('BASEPATH') OR exit('No direct script access allowed');

class TokenController extends CI_Controller
{
	const SECRET_KEY = 'spaceship';

	public function index()
	{
		$token = array(
			"user" => "altair",
			"email" => "altemia.decoy@gmail.com"
		);

		$jwt = JWT::encode($token, self::SECRET_KEY);

		echo $jwt;
	}
}

