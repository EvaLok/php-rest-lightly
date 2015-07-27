<?php

namespace api\v1\Restricted;

use RestLightly\v1\Endpoint\Identified as Endpoint;

class Thing3 extends Endpoint {
	public function get( Array $params )
	{
		return $this->respond([
			'id' => $this->id,
			'owner' => (array)$this->owner,
			'class' => __CLASS__,
			'method' => __METHOD__,
			'message' => 'testing testing 123',
			'params' => $params
		]);
	}
	
	public function post( Array $params )
	{
		return $this->respond([
			'id' => $this->id,
			'owner' => (array)$this->owner,
			'class' => __CLASS__,
			'method' => __METHOD__,
			'message' => 'testing testing 123',
			'params' => $params
		]);
	}
	
	public function put( Array $params )
	{
		return $this->respond([
			'id' => $this->id,
			'owner' => (array)$this->owner,
			'class' => __CLASS__,
			'method' => __METHOD__,
			'message' => 'testing testing 123',
			'params' => $params
		]);
	}
}
