<?php

namespace The86\Tests;

use The86\Command;
use The86\TestCase;

class ListConversationsTest extends TestCase
{
	private $client;
	private $command;

	public function setUp()
	{
		$this->client = $this->getServiceBuilder()->get('client');
		$this->command = $this->client->getCommand('ListConversations', array('site' => 'example'));
	}

	public function testListingConversations()
	{
		$this->setMockResponse($this->client, "sites_example_conversations.http");

		$result = $this->command->execute();

		$request = $this->getOnlyMockedRequest();
		$this->assertEquals('/api/v1/sites/example/conversations', $request->getPath());

		// JSON-decoded response data.
		$this->assertEquals(2, count($result));
		$this->assertEquals(51, $result[0]['id']);
	}
}
