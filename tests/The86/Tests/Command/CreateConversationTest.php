<?php

namespace The86\Tests;

use The86\Command;
use The86\TestCase;

class CreateConversationTest extends TestCase
{
    public function setUp()
    {
        $this->setMockResponse($this->client(), 'create_conversation.http');
    }

    public function testCreatingConversation()
    {
        $result = $this->client()->getCommand('CreateConversation', array(
            'group' => 'test',
            'oauth_token' => 'topsecret',
            'attributes' => array(
                'content' => 'Hello!'
            )
        ))->execute();

        $request = $this->assertRequest('POST', '/api/v1/groups/test/conversations');
        $this->assertBearerToken('topsecret', $request);
        $this->assertRequestJson(array('content' => 'Hello!'), $request);

        $this->assertEquals(2345, $result->id);
        $this->assertInternalType('array', $result->posts);

        $posts = $result->posts;
        $this->assertEquals(1, count($posts));
        $this->assertEquals('Hello!', $posts[0]->content);
        $this->assertTrue($posts[0]->is_original);
        $this->assertEquals('John Citizen', $posts[0]->user->name);
    }
}
