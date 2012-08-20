<?php

namespace The86;

class TestCase extends \Guzzle\Tests\GuzzleTestCase
{
    private $client;

    protected function client()
    {
        if (!$this->client)
            $this->client = $this->getServiceBuilder()->get('client');

        return $this->client;
    }

	protected function getOnlyMockedRequest()
	{
		$requests = $this->getMockedRequests();
		$count = count($requests);

		if ($count != 1)
			$this->fail("Expected 1 HTTP request, got $count!");
		else
			return $requests[0];
	}
}
