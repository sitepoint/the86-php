<?php

namespace The86;

class ConversationTest extends \PHPUnit_Framework_TestCase
{
	private $conversation;
	private $http;

	public function setUp()
	{
		$path = "/api/v1/sites/example/conversations";
		$attributes = array('id' => 16);
		$this->http = $this->getMock('Http', array('get', 'patch', 'post'));
		$this->conversation = new Conversation($this->http, $path, $attributes);
	}

	public function testHasManyPosts()
	{
		$response = array(
			array('id' => 2),
			array('id' => 4),
		);

		$this->http->expects($this->once())
			->method("get")
			->with("/api/v1/sites/example/conversations/16/posts")
			->will($this->returnValue($response));

		$posts = $this->conversation->posts()->toArray();

		$this->assertEquals(2, count($posts));
		$this->assertEquals(2, $posts[0]['id']);
		$this->assertEquals(4, $posts[1]['id']);
	}
}
