<?php

namespace The86;

class ResourceCollection
	implements \IteratorAggregate, \ArrayAccess, \Countable
{
	private $_className;
	private $_http;
	private $_iterator;
	private $_parent;
	private $_pathName;
	private $_records;

	public function __construct($http, $pathName, $className, $parent, $records = null)
	{
		$this->_http = $http;
		$this->_pathName = $pathName;
		$this->_className = $className;
		$this->_parent = $parent;
		$this->_records = $records;
	}

	// -----------

	public function build($attributes = array())
	{
		return new $this->_className(
			$this->_http,
			$attributes,
			$this->_parent
		);
	}

	public function create($attributes = array())
	{
		$resource = $this->build($attributes);
		$resource->save();
		return $resource;
	}

	public function find($id)
	{
		return $this->build(array('id' => $id));
	}

	// -----------------
	// IteratorAggregate

	public function getIterator()
	{
		if (!isset($this->_iterator))
			$this->_iterator = new \ArrayObject(array_map(
				array($this, "build"),
				$this->_fetch()
			));

		return $this->_iterator;
	}

	// ---------
	// Countable

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

	private function _fetch()
	{
		return $this->_http->get($this->_pathName);
	}
}
