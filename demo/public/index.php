<?php

// example autoloading; not necessary when using module as dependency
// ----------------------------------------------------------------------------
require(__DIR__ . '/autoloader.php');
// ----------------------------------------------------------------------------

use 
	RestLightly\v1\Controller
		,
	RestLightly\v1\Endpoint\Exception
			as EndpointException
;

try {
	$response = Controller::route([
		'path' => trim(
			(
				strpos($_SERVER['REQUEST_URI'], '?')
					?
				strstr(strstr($_SERVER['REQUEST_URI'], '/api/'), '?', true)
					:
				strstr($_SERVER['REQUEST_URI'], '/api/')
			), 
			'/?'
		),
		'method' => $_SERVER['REQUEST_METHOD'],
		'methods_allowed' => [
			'get',
			'post',
			'put',
			'patch',
			'delete',
			'update'
		],
		'path_root' => 'api/'
	]);
} catch( EndpointException $ex ){
	// ~!!~ log exception?
	
	$response['headers'] = [
		[
			'string' => $ex->getCode() . ': ' . $ex->getMessage(),
			'replace' => true,
			'code' => $ex->getCode()
		]
	];
}

foreach( $response['headers'] as $header ){
	header($header['string'], $header['replace'], $header['code']);
}

if( ! empty($response['body']) ){
	echo json_encode($response['body']);
}

