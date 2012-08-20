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
        $command = $this->client()->getCommand('ShowUser', array(
            'user' => 1024
        ));

        $result = $command->execute();

        $request = $this->getOnlyMockedRequest();

        $this->assertEquals('/api/v1/users/1024', $request->getResource());

        $this->assertEquals(1024, $result['id']);
        $this->assertEquals('John Citizen', $result['name']);
    }
}
