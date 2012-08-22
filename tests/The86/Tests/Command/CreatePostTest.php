<?php

namespace The86\Tests;

use The86\Command;
use The86\TestCase;

class CreatePostTest extends TestCase
{
    public function setUp()
    {
        $this->setMockResponse($this->client(), 'create_post.http');
    }

    public function testCreatingPost()
    {
        $result = $this->client()->getCommand('CreatePost', array(
            'site' => 'example',
            'conversation' => 2468,
            'oauth_token' => 'topsecret',
            'attributes' => array(
                'content' => 'Hello!'
            )
        ))->execute();

        $request = $this->assertRequest('POST',
            '/api/v1/sites/example/conversations/2468/posts');
        $this->assertBearerToken('topsecret', $request);
        $this->assertRequestJson(array('content' => 'Hello!'), $request);

        $this->assertEquals(4096, $result['id']);
        $this->assertEquals('Hello!', $result['content']);
        $this->assertFalse($result['is_original']);
        $this->assertEquals('John Citizen', $result['user']['name']);
    }
}
