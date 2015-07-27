<?php

namespace RestLightly\v1;

use	RestLightly\v1\Parser\Path as PathParser;

/**
 * instantiates an endpoint based on a path
 */
class Instantiator {
	static public function instantiate($path, $namespace) {
		return (new PathParser($path, $namespace))->getEndpoint();
	}
}
