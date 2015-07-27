<?php

namespace RestLightly\v1\Parser;

use RestLightly\v1\Parser\Data\Exception;

class Data {
	private	$method;
	private $data = [];

	public function __construct($method) {
		return $this->parseDataByMethod($method);
	}

	protected function parseDataByMethod($method) {
		switch ($this->method = strtolower($method)) {
			case 'get':
				$this->data = $_GET ?: [];
				break;

			case 'post':
				$this->data = $_POST ?: [];
				break;

			default:
				$input = file_get_contents('php://input');

				// first try json_decode, fallback to parse_str
				if (!$this->data = json_decode($input)) {
					parse_str($input, $this->data);
				}
		}

		if (!is_array($this->data)) {
			throw new Exception("unable to parse data");
		}

		return $this;
	}

	public function getMethod() {
		return $this->method;
	}

	public function getData() {
		return $this->data;
	}
}
