<?php

namespace The86;

class Resource
{
	private $_attributes = array();

	public function __construct($attributes)
	{
		$this->_attributes = $attributes;
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
}
