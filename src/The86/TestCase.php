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

	protected function getOnlyMockedRequest($path = null)
	{
		$requests = $this->getMockedRequests();
		$count = count($requests);

		if ($count != 1)
			$this->fail("Expected 1 HTTP request, got $count!");

        $request = $requests[0];

        if ($path)
            $this->assertRequestPath($path, $request);

        return $request;
	}

    protected function assertRequestPath($path, $request = null)
    {
        if (!$request) $request = $this->getOnlyMockedRequest();
        $this->assertEquals($path, $request->getResource());
    }
}
