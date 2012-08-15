<?php

namespace The86;

class ApiRoot
{
	public function __construct($http = null)
	{
		$this->_http = $http;
	}

	public function sites()
	{
		return $this->_collection('sites', 'The86\Site');
	}

	public function users()
	{
		return $this->_collection('users', 'The86\User');
	}

	// ----------

	private function _collection($pathName, $className)
	{
		return new ResourceCollection(
			$this->_http(),
			$pathName,
			$className,
			null,
			null
		);
	}

	private function _http()
	{
		if (!isset($this->_http))
			$this->_http = new Http();

		return $this->_http;
	}
}
