<?php

namespace The86;

class UserTest extends \PHPUnit_Framework_TestCase
{
	private $user;
	private $http;

	public function setUp()
	{
		$this->http = $this->getMock('Http', array('get', 'patch', 'post'));
		$this->user = new User($this->http, array('name' => 'John Citizen'));
	}

	// -----------

	public function testAttributeAccess()
	{
		$this->assertEquals('John Citizen', $this->user->name);
		$this->user->name = 'Another';
		$this->assertEquals(array('name' => 'Another'), $this->user->attributes());
	}

	public function testSaveToCreate()
	{
		$this->http->expects($this->once())
			->method("post")
			->with("users")
			->will($this->returnValue(array('id' => 4)));

		$this->user->save();
		$this->assertEquals(4, $this->user->id);
	}

	public function testSaveToUpdate()
	{
		$response = array(
			'id' => 8,
			'updated_at' => '2012-08-14T00:00:00Z',
		);

		$this->http->expects($this->once())
			->method("patch")
			->with("users/8")
			->will($this->returnValue($response));

		$this->user->id = 8;
		$this->user->save();
		$this->assertEquals(8, $this->user->id);
		$this->assertEquals('2012-08-14T00:00:00Z', $this->user->updated_at);
	}
}
