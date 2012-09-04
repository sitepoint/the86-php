<?php

namespace The86\Tests;

use The86\Command;
use The86\TestCase;

class ShowUserTest extends TestCase
{
    public function setUp()
    {
        $this->setMockResponse($this->client(), 'users_1024.http');
    }

    public function testShowingUser()
    {
        $result = $this->client()->getCommand('ShowUser', array(
            'user' => 1024
        ))->execute();

        $this->assertBasicAuth('auser', 'apass');
        $this->assertRequest('GET', '/api/v1/users/1024');
        $this->assertEquals(1024, $result->id);
        $this->assertEquals('John Citizen', $result->name);
    }
}
