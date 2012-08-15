<?php

namespace The86;

class ResourceCollection
	implements \IteratorAggregate, \ArrayAccess, \Countable
{
	private $_className;
	private $_http;
	private $_iterator;
	private $_parameters;
	private $_parent;
	private $_path;
	private $_records;

	public function __construct($http, $path, $className, $parent, $records = null)
	{
		$this->_http = $http;
		$this->_path = $path;
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
		return $this->build(array('id' => $id))->load();
	}

	public function withParameters($parameters)
	{
		$collection = clone($this);
		$collection->_parameters = $parameters;
		return $collection;
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
		$path = $this->_parameters ?
			sprintf('%s?%s', $this->_path, http_build_query($this->_parameters)) :
			$this->_path;

		return $this->_http->get($path);
	}
}
