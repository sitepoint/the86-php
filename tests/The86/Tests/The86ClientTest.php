<?php

namespace The86\Tests;

use The86\The86Client;
use The86\TestCase;

class The86ClientTest extends TestCase
{
    public function testBuilderCreatesClient()
    {
		$client = The86Client::factory(array(
			'domain' => 'factory.example.org',
			'username' => 'factoryuser',
			'password' => 'factorypassword',
		));

		$this->assertInstanceOf("\The86\The86Client", $client);
    }

	/**
	 * @expectedException \Guzzle\Service\Exception\ValidationException
	 */
	public function testBuilderRequiresConfiguration()
	{
		The86Client::factory(array());
	}

	public function testListingConversations()
	{
		$client = $this->getServiceBuilder()->get('client');
		$this->setMockResponse($client, "sites_example_conversations.http");
		$request = $client->get('sites/example/conversations');
		$response = $request->send();

		$this->assertEquals(200, $response->getStatusCode());
		$data = json_decode($response->getBody());
		$this->assertEquals(2, count($data));
		$this->assertEquals(51, $data[0]->id);
	}
}
