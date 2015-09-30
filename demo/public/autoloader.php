<?php

// this is just for the demo, don't use it for anything else..
// ----------------------------------------------------------------------------
spl_autoload_register(function($class){	
	$path = str_replace('\\', '/', $class);
	
	if( file_exists($file = (__DIR__ . '/../src/' . '/' . $path . '.php')) ){
		require_once($file);
	}
});
spl_autoload_register(function($class){
	if( strpos($class, 'RestLightly') !== 0 ){
		return;
	}
	
	$path = str_replace(
		[
			'\\',
			'RestLightly/'
		], 
		[
			'/',
			''
		], 
		$class
	);
	
	if( file_exists($file = (__DIR__ . '/../../src' . '/' . $path . '.php')) ){
		require_once($file);
	}
});
// ----------------------------------------------------------------------------
