<?php

namespace The86;

class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->http = $this->getMock('Http', array('get', 'patch', 'post'));
		$this->site = new Site($this->http, array('slug' => 'example'));
	}

	// -----------

	public function testAttributeAccess()
	{
		$this->assertEquals('example', $this->site->slug);
		$this->site->slug = 'example.com';
		$this->assertEquals(array('slug' => 'example.com'), $this->site->attributes());
	}

	public function testHasManyConversations()
	{
		$response = array(
			array('id' => 2),
			array('id' => 4),
		);

		$this->http->expects($this->once())
			->method("get")
			->with("sites/example/conversations")
			->will($this->returnValue($response));

		$conversations = $this->site->conversations();

		$this->assertEquals(2, count($conversations));

		$this->assertInstanceOf("The86\Conversation", $conversations[0]);
		$this->assertEquals(2, $conversations[0]->id);
		$this->assertEquals(4, $conversations[1]->id);
	}
}
