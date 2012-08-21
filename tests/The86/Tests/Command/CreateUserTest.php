<?php

namespace The86\Tests;

use The86\Command;
use The86\TestCase;

class CreateUserTest extends TestCase
{
    public function setUp()
    {
        $this->setMockResponse($this->client(), 'create_user.http');
    }

    public function testCreatingUser()
    {
        $result = $this->client()->getCommand('CreateUser', array(
            'attributes' => array(
                'name' => 'John Citizen'
            )
        ))->execute();

        $this->assertRequest('POST', '/api/v1/users');
        $this->assertBasicAuth('auser', 'apass');

        $this->assertEquals(2048, $result['id']);
        $this->assertEquals('John Citizen', $result['name']);
        $this->assertEquals(
            'Gbit5a7iy-nOVdrt-6U8B9nUA4z90hCpcesRSEU38y4',
            $result['access_tokens'][0]['token']
        );
    }
}
