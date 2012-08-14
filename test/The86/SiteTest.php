<?php

namespace The86;

class SiteTest extends \PHPUnit_Framework_TestCase
{
	function testAttributeAccess()
	{
		$site = new Site(array('slug' => 'example.org'));
		$this->assertEquals($site->slug, 'example.org');
		$site->slug = 'example.com';
		$this->assertEquals($site->toArray(), array('slug' => 'example.com'));
	}
}
