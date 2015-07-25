<?php

namespace RestLightly\v1\Endpoint;

use RestLightly\v1\Endpoint;

class Identified extends Endpoint {
	protected $id;
	
	public function setId( $id )
	{
		$this->id = (int)$id;
	}
	
	public function getId()
	{
		return $this->id;
	}
}
