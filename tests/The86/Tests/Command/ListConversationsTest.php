<?php

namespace The86\Tests;

use The86\Command;
use The86\TestCase;

class ListConversationsTest extends TestCase
{
    public function setUp()
    {
        $this->setMockResponse($this->client(), "sites_example_conversations.http");
    }

    public function testListingConversations()
    {
        $command = $this->client()->getCommand('ListConversations', array(
            'site' => 'example',
        ));

        $result = $command->execute();

        $request = $this->getOnlyMockedRequest();
        // NOTE: the ?parameters= is a bug in Guzzle's UriTemplate
        // implementation fixed by https://github.com/guzzle/guzzle/pull/123
        $this->assertRegExp(
            '#^/api/v1/sites/example/conversations(\?parameters=)?$#',
            $request->getResource()
        );

        $this->assertBasicAuth('auser', 'apass', $request);

        // JSON-decoded response data.
        $this->assertEquals(2, count($result));
        $this->assertEquals(51, $result[0]['id']);
    }

    public function testPostsSince()
    {
        $this->client()->getCommand('ListConversations', array(
            'site' => 'test',
            'parameters' => array(
                'posts_since' => 'time',
            ),
        ))->execute();

        $this->assertBasicAuth('auser', 'apass');
        $this->assertRequest(
            'GET',
            '/api/v1/sites/test/conversations?posts_since=time'
        );
    }
}
