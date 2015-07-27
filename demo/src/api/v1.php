<?php

namespace api;

use RestLightly\v1\Endpoint;

class v1 extends Endpoint {
	public function __construct() {
		// @todo: add deprecated call here
	}

	public function get(Array $params) {
		return $this->respond([
			'class' => __CLASS__,
			'method' => __METHOD__,
			'message' => 'api version one, could put documentation here',
			'params' => $params
		]);
	}
}
