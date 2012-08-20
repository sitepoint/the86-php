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

	protected function getOnlyMockedRequest($method = null, $path = null)
	{
		$requests = $this->getMockedRequests();
		$count = count($requests);

		if ($count != 1)
			$this->fail("Expected 1 HTTP request, got $count!");

        $request = $requests[0];

        if ($method && $path)
            $this->assertRequest($method, $path, $request);
        else if ($method || $path)
            $this->fail('$method and $path must both be present or null.');

        return $request;
	}

    protected function assertRequest($method, $path, $request = null)
    {
        if (!$request) $request = $this->getOnlyMockedRequest();
        $this->assertEquals($method, $request->getMethod());
        $this->assertEquals($path, $request->getResource());
    }
}
