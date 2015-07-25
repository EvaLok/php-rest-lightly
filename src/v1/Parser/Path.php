<?php

namespace RestLightly\v1\Parser;

use 
	ReflectionClass,
	ReflectionException

;

class Path {
	private 
		$parts
		, $namespace
		, $endpoint
	;
	
	public function __construct( $path, $namespace )
	{
		$this->parts = explode('/', $path);
		$this->namespace = str_replace('/', '\\', $namespace);
		
		$this->parse($this->parts);
		
		return $this;
	}
	
	private function parse( $parts, $idx = 0, $owner = false)
	{
		$ns = (
			is_object($owner)
				?
			$owner->getNamespace()
				:
			$this->namespace
		);
		
		try {
			$obj = (new ReflectionClass($ns . $parts[$idx]))->newInstance();
		} catch( ReflectionException $ex ){
			var_dump( $ex ); exit;
		}
		
		
		var_dump( get_class($obj) ); exit;
		
		// check if class has `parseId` method
			// parse id
		
		// recurse
			// if last idx hit, set endpoint
	}
	
	public function getEndpoint()
	{
		return $this->endpoint;
	}
}
