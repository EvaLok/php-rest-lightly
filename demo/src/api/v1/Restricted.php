<?php

namespace api\v1;

use	RestLightly\v1\Endpoint,
	RestLightly\v1\Endpoint\Exception;

class Restricted extends Endpoint {
	public function __construct() {
		// authorise vs session / token / whatever..
		// failure will block all child resources
		// for demo purposes, always throw 403
		// if you comment this out, resource api/v1/Restricted/Thing3 is visible
		throw new Exception("Forbidden", 403);
	}

	public function get(Array $params) {
		return $this->respond([
			'id' => $this->id, // TODO: find where this comes from
			'owner' => (array)$this->owner,
			'class' => __CLASS__,
			'method' => __METHOD__,
			'message' => 'restricted',
			'params' => $params
		]);
	}
}
