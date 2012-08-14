<?php

namespace The86;

class Resource
{
	private $_attributes = array();
	private $_http;
	private $_collectionPath;

	public function __construct($http, $collectionPath, $attributes)
	{
		$this->_attributes = $attributes;
		$this->_http = $http;
		$this->_collectionPath = $collectionPath;
	}

	private function path()
	{
		return $this->_collectionPath . "/" . $this->pathParameter();
	}

	protected function pathParameter()
	{
		return $this->id;
	}

	// Persistence.

	public function save()
	{
		if ($this->id)
		{
			$this->_attributes = $this->_http->patch(
				$this->path(),
				$this->toArray()
			);
		}
		else
		{
			$this->_attributes = $this->_http->post(
				$this->_collectionPath,
				$this->toArray()
			);
		}
	}

	// Attribute access.

	public function __get($attribute)
	{
		return $this->_attributes[$attribute];
	}

	public function __set($attribute, $value)
	{
		return $this->_attributes[$attribute] = $value;
	}

	public function toArray()
	{
		return $this->_attributes;
	}

	// Collections.

	protected function _collection($name, $className)
	{
		return new ResourceCollection(
			$this->_http,
			implode("/", array($this->path(), $name)),
			$className
		);
	}
}
