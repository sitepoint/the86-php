<?php

namespace The86;

class Resource
{
	private $_attributes = array();
	private $_http;
	private $_parent;

	public function __construct($http, $attributes = array(), $parent = null)
	{
		$this->_http = $http;
		$this->_attributes = $attributes;
		$this->_parent = $parent;
	}

	// -----------

	public static function collectionPath($parent)
	{
		if ($parent)
		{
			return $parent->resourcePath() . "/" . static::$path;
		}
		else
		{
			return static::$path;
		}
	}

	// -----------

	public function resourcePath()
	{
		return implode("/", array(
			static::collectionPath($this->_parent),
			$this->pathParameter()
		));
	}

	public function attributes()
	{
		return $this->_attributes;
	}

	// -----------

	public function save()
	{
		if ($this->id)
		{
			$this->_attributes = $this->_http->patch(
				$this->resourcePath(),
				$this->attributes()
			);
		}
		else
		{
			$this->_attributes = $this->_http->post(
				static::collectionPath($this->_parent),
				$this->attributes()
			);
		}
	}

	// -----------
	// Attribute access.

	public function __get($attribute)
	{
		return $this->_attributes[$attribute];
	}

	public function __set($attribute, $value)
	{
		return $this->_attributes[$attribute] = $value;
	}

	// -----------

	protected function pathParameter()
	{
		return $this->id;
	}

	protected function collection($name, $className)
	{
		return new ResourceCollection(
			$this->_http,
			$className::collectionPath($this),
			$className,
			$this
		);
	}
}
