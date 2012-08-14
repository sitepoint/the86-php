<?php

namespace The86;

class ResourceCollection
{
	public function __construct($http, $path)
	{
		$this->_http = $http;
		$this->_path = $path;
	}

	public function toArray()
	{
		return $this->_http->get($this->_path);
	}
}
