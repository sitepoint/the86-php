<?php

namespace The86;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
	private $http;
	private $root;

	public function setUp()
	{
		$this->http = $this->getMock('Http', array('get', 'post'));
		$this->root = new ApiRoot($this->http);
	}

	// ----------

	public function testListConversations()
	{
		$this->http->expects($this->once())
			->method('get')
			->with("sites/example/conversations")
			->will($this->returnValue(array()));

		$conversations = $this->root
			->sites()
			->build(array('slug' => 'example'))
			->conversations();

		$this->assertInstanceOf("The86\ResourceCollection", $conversations);

		$conversations->getIterator();
	}

	public function testListConversationsWithPostsSince()
	{
		$this->http->expects($this->once())
			->method('get')
			->with("sites/example/conversations?posts_since=time")
			->will($this->returnValue(array()));

		$conversations = $this->root
			->sites()
			->build(array('slug' => 'example'))
			->conversations()
			->withParameters(array('posts_since' => 'time'));

		$this->assertInstanceOf("The86\ResourceCollection", $conversations);

		$conversations->getIterator();
	}

	public function testCreateUser()
	{
		$this->http->expects($this->once())
			->method('post')
			->with("users", array('name' => 'Johnny Integration'))
			->will($this->returnValue(array(
				'id' => 4,
				'name' => 'Johnny Integration',
			)));

		$user = $this->root->users()->create(array(
			'name' => 'Johnny Integration',
		));

		$this->assertInternalType('integer', $user->id);
		$this->assertGreaterThan(0, $user->id);
		$this->assertEquals('Johnny Integration', $user->name);
	}

	public function testCreatePost()
	{
		$this->http->expects($this->once())
			->method('post')
			->with(
				'sites/example/conversations/8/posts',
				array('content' => 'Post!')
			)
			->will($this->returnValue(array(
				'id' => 16,
				'content' => 'Post!',
				'content_html' => '<p>Post!</p>',
			)));

		$post = $this->root
			->sites()
			->build(array('slug' => 'example'))
			->conversations()
			->build(array('id' => 8))
			->posts()
			->create(array(
				'content' => 'Post!',
			));

		$this->assertInternalType('integer', $post->id);
		$this->assertGreaterThan(0, $post->id);
		$this->assertEquals('Post!', $post->content);
		$this->assertEquals('<p>Post!</p>', $post->content_html);
	}
}
