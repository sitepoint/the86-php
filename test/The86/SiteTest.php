<?php

namespace The86;

class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$path = "/api/v1/sites";
		$this->http = $this->getMock('Http', array('get', 'patch', 'post'));
		$this->site = new Site($this->http, $path, array('slug' => 'example'));
	}

	public function testAttributeAccess()
	{
		$this->assertEquals('example', $this->site->slug);
		$this->site->slug = 'example.com';
		$this->assertEquals(array('slug' => 'example.com'), $this->site->toArray());
	}

	public function testHasManyConversations()
	{
		$response = array(
			array('id' => 2),
			array('id' => 4),
		);

		$this->http->expects($this->once())
			->method("get")
			->with("/api/v1/sites/example/conversations")
			->will($this->returnValue($response));

		$conversations = $this->site->conversations()->toArray();

		$this->assertEquals(2, count($conversations));
		$this->assertEquals(2, $conversations[0]['id']);
		$this->assertEquals(4, $conversations[1]['id']);
	}
}
