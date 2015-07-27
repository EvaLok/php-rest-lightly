<?php

namespace RestLightly\v1\Parser;

use    ReflectionClass,
	ReflectionException,
	RestLightly\v1\Parser\Path\Exception as Exception,
	RestLightly\v1\Endpoint\Identified as IdentifiedEndpoint;

class Path {
	private $parts;
	private $namespace;
	private $endpoint;

	public function __construct($path, $namespace) {
		$this->parts = explode('/', $path);
		$this->namespace = str_replace('/', '\\', $namespace);

		return $this->parse($this->parts);
	}

	private function parse($parts, $idx = 0, $owner = false) {
		// determine namespace
		$ns = (
		is_object($owner)
			?
			get_class($owner) . '\\'
			:
			$this->namespace
		);

		// create object instance
		try {
			$obj = (new ReflectionClass($ns . $parts[$idx]))->newInstance();
			$idx++;
		} catch (ReflectionException $ex) {
			throw new Exception($ex->getMessage());
		}

		// if applicable, set owner
		if (is_object($owner)) {
			$obj->setOwner($owner);
		}

		// check if class is identifiable
		if ($obj instanceof IdentifiedEndpoint) {
			if (!isset($parts[$idx])) {
				throw new Exception("ID not set");
			}

			$obj->setId($parts[$idx]);
			$idx++;
		}

		// if still parts left to parse, recurse
		if (isset($parts[$idx])) {
			return $this->parse($parts, $idx, $obj);
		}

		$this->endpoint = $obj;

		return $this;
	}

	public function getEndpoint() {
		return $this->endpoint;
	}
}
