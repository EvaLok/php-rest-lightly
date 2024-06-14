<?php

namespace RestLightly\v1;

use
	RestLightly\v1\Instantiator
		,
	RestLightly\v1\Parser\Path\Exception
		as PathParserException
		,
	RestLightly\v1\Parser\Data
			as DataParser
		,
	RestLightly\v1\Parser\Data\Exception
			as DataParserException
		,
	RestLightly\v1\Endpoint\Exception
			as EndpointException
;

class Controller {
	/**
	 * Expected Params:
	 * 	- (string) path
	 * 	- (string) data
	 * 	- (array) methods_allowed
	 *	- (string) path_root
	 */
	static public function route( Array $params )
	{
		// check for valid path
		if( ! static::isValidPath([
			'path' => $params['path'],
			'path_root' => $params['path_root']
		]) ){
			throw new EndpointException("Bad Request", 400);
		} else {
			$params['path'] = substr(
				$params['path'],
				strlen($params['path_root'])
			);
		}
		
		// parse data
		try {
			$data = (new DataParser($params['method']))->getData();
		} catch( DataParserException $ex ){
			throw new EndpointException("Bad Data", 400);
		}
		
		// instantiate endpoint
		try {
			$endpoint = Instantiator::instantiate(
				$params['path'],
				$params['path_root']
			);
		} catch( PathParserException $ex ){
			throw new EndpointException("Not Found", 404);
		}
		
		// fetch response from endpoint
		$response = call_user_func([$endpoint, $params['method']], $data);
		
		return [
			'headers' => (
				! empty($response['headers']) 
					? 
				$response['headers'] 
					: 
				[
					[
						'string' => 'content-type: application/json',
						'replace' => null,
						'code' => null
					]
				]
			),
			'body' => $response['body'] ?? null
		];
	}
	
	/**
	 * Expected Params:
	 * 	- (string) path
	 *	- (string) path_root
	 */
	static public function isValidPath( Array $params )
	{
		if( strpos($params['path'], $params['path_root']) !== 0 ){
			return false;
		}
		
		return true;
	}
}
