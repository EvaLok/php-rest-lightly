<?php

namespace RestLightly\v1;

use 
	RestLightly\v1\Endpoint\Exception,
	ReflectionClass
;

abstract class Endpoint {
	protected $owner;
	
	protected function respond( array $response )
	{
		if( empty($response['headers']) || empty($response['body']) ){
			return [
				'body' => $response
			];
		} else {
			return $response;
		}
	}
	
	public function setOwner( Endpoint $owner )
	{
		$this->owner = $owner;
	}
	
	public function getOwner()
	{
		return $this->owner;
	}
	
	public function get( Array $params )
	{
		throw new Exception('Method Not Allowed', 405);
	}
	
	public function post( Array $params )
	{
		throw new Exception('Method Not Allowed', 405);
	}
	
	public function put( Array $params )
	{
		throw new Exception('Method Not Allowed', 405);
	}
	
	public function patch( Array $params )
	{
		throw new Exception('Method Not Allowed', 405);
	}
	
	public function delete( Array $params )
	{
		throw new Exception('Method Not Allowed', 405);
	}
	
	public function update( Array $params )
	{
		throw new Exception('Method Not Allowed', 405);
	}
}
