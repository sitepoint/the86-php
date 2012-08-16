<?php

namespace The86;

class TestCase extends \Guzzle\Tests\GuzzleTestCase
{
	public function getOnlyMockedRequest()
	{
		$requests = $this->getMockedRequests();
		$count = count($requests);

		if ($count != 1)
			$this->fail("Expected 1 HTTP request, got $count!");
		else
			return $requests[0];
	}
}
