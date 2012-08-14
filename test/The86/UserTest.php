<?php

namespace The86;

class UserTest extends \PHPUnit_Framework_TestCase
{
	function testAttributeAccess()
	{
		$user = new User(array('name' => 'John Citizen'));
		$this->assertEquals($user->name, 'John Citizen');
		$user->name = 'Another';
		$this->assertEquals($user->toArray(), array('name' => 'Another'));
	}
}
