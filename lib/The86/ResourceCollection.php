<?php

namespace The86;

class ResourceCollection
	implements \IteratorAggregate, \ArrayAccess, \Countable
{
	private $_http;
	private $_iterator;
	private $_path;
	private $_records;

	public function __construct($http, $path, $className)
	{
		$this->_http = $http;
		$this->_path = $path;
		$this->_className = $className;
	}

	// -----------------
	// IteratorAggregate

	public function getIterator()
	{
		if (!isset($this->_iterator))
		{
			$this->_iterator = new \ArrayObject(array_map(
				array($this, "_toResource"),
				$this->_http->get($this->_path)
			));
		}
		return $this->_iterator;
	}

	public function count()
	{
		return $this->getIterator()->count();
	}

	// -----------
	// ArrayAccess

	public function offsetExists($k)  { return $this->getIterator()->offsetExists($k);  }
	public function offsetGet($k)     { return $this->getIterator()->offsetGet($k);     }
	public function offsetSet($k, $v) { return $this->getIterator()->offsetSet($k, $v); }
	public function offsetUnset($k)   { return $this->getIterator()->offsetUnset($k);   }

	// -----------

	public function toArray()
	{
		$this->getIterator()->getArrayCopy();
	}

	/**
	 * Turn a bare array into a typed resource object.
	 */
	private function _toResource($array)
	{
		$class = $this->_className;
		$collectionPath = "TODO";
		return new $class($this->_http, $collectionPath, $array);
	}
}
