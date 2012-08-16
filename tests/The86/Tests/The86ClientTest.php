<?php

namespace The86\Tests;

use The86\The86Client;

class The86ClientTest extends \Guzzle\Tests\GuzzleTestCase
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
}
