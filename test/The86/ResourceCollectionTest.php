<?php

namespace The86;

class ResourceCollectionTest extends \PHPUnit_Framework_TestCase
{
	private $http;
	private $collection;

	public function _setUpTwoSites()
	{
		$this->http = $this->getMock("Http", array('get'));
		$path = "sites";

		$this->collection = new ResourceCollection(
			$this->http,
			"sites",
			"The86\Site",
			null
		);

		$this->response = array(
			array('id' => 2),
			array('id' => 4),
		);

		$this->http->expects($this->once())
			->method("get")
			->with("sites")
			->will($this->returnValue(array(
				array('id' => 2),
				array('id' => 4),
			)));
	}

	// -----------

	public function testIteration()
	{
		$this->_setUpTwoSites();

		$count = 0;
		foreach ($this->collection as $item)
		{
			$this->assertInstanceOf("The86\Site", $item);
			$count++;
		}
		$this->assertEquals(2, $count);
	}

	public function testArrayAccess()
	{
		$this->_setUpTwoSites();

		$this->assertInstanceOf("The86\Site", $this->collection[0]);
		$this->assertInstanceOf("The86\Site", $this->collection[1]);

		$this->assertEquals(2, $this->collection[0]->id);
		$this->assertEquals(4, $this->collection[1]->id);
	}

	public function testFind()
	{
		$http = $this->getMock('Http', array('get'));
		$http->expects($this->once())
			->method('get')
			->with('users/10')
			->will($this->returnValue(array(
			)));

		$collection = new ResourceCollection(
			$http, 'users', 'The86\User', null
		);

		$collection->find(10);
	}
}
