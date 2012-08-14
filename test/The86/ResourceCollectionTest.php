<?php

namespace The86;

class ResourceCollectionTest extends \PHPUnit_Framework_TestCase
{
	private $http;
	private $path;
	private $collection;

	public function setUp()
	{
		$this->http = $this->getMock("Http", array('get'));
		$this->path = "/api/v1/sites";
		$this->collection = new ResourceCollection(
			$this->http,
			$this->path,
			"The86\Site"
		);

		$this->response = array(
			array('id' => 2),
			array('id' => 4),
		);

		$this->http->expects($this->once())
			->method("get")
			->with($this->path)
			->will($this->returnValue(array(
				array('id' => 2),
				array('id' => 4),
			)));
	}

	public function testIteration()
	{
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
		$this->assertInstanceOf("The86\Site", $this->collection[0]);
		$this->assertInstanceOf("The86\Site", $this->collection[1]);

		$this->assertEquals(2, $this->collection[0]->id);
		$this->assertEquals(4, $this->collection[1]->id);
	}
}
