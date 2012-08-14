<?php

namespace The86;

class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function testAttributeAccess()
	{
		$site = new Site($this->_http, "", array('slug' => 'example.org'));
		$this->assertEquals($site->slug, 'example.org');
		$site->slug = 'example.com';
		$this->assertEquals($site->toArray(), array('slug' => 'example.com'));
	}

	public function testHasManyConversations()
	{
		$response = array(
			array('id' => 2),
			array('id' => 4),
		);

		$path = "/api/v1/sites/example/conversations";
		$http = $this->getMock('Http', array('get'));
		$http->expects($this->once())
			->method("get")
			->with($path)
			->will($this->returnValue($response));

		$site = new Site($http, "/api/v1/sites", array('slug' => 'example'));
		$conversations = $site->conversations()->toArray();

		$this->assertEquals(count($conversations), 2);
		$this->assertEquals($conversations[0]['id'], 2);
		$this->assertEquals($conversations[1]['id'], 4);
	}

	// ----------

	private function _http()
	{
	}
}
