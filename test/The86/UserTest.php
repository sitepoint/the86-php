<?php

namespace The86;

class UserTest extends \PHPUnit_Framework_TestCase
{
	private $user;
	private $http;

	public function setUp()
	{
		$this->http = $this->getMock('Http', array('get', 'post'));
		$this->user = new User($this->http, "/api/v1/users", array('name' => 'John Citizen'));
	}

	public function testAttributeAccess()
	{
		$this->assertEquals($this->user->name, 'John Citizen');
		$this->user->name = 'Another';
		$this->assertEquals($this->user->toArray(), array('name' => 'Another'));
	}

	public function testSaveToCreate()
	{
		$this->http->expects($this->once())
			->method("post")
			->with("/api/v1/users")
			->will($this->returnValue(array('id' => 4)));

		$this->user->save();
		$this->assertEquals($this->user->id, 4);
	}
}
