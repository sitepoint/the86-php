#!/usr/bin/env php
<?php

// PHPUnit does insane things with items initialized in global scope.
// Specifically, using DirectoryIterator in global scope makes PHPUnit
// crash when it tries to serialize (!!!) everything in global scope.
// Even when no reference to the DirectoryIterator was held.
// Really.
// Even this guy agrees: https://github.com/sebastianbergmann/phpunit/issues/214

call_user_func(function () {

	// Find test libraries.
	$libraries = array();
	foreach (new DirectoryIterator(__DIR__ . "/../testlib") as $entry)
		if (!$entry->isDot()) $libraries  []= $entry->getPathname();

	// Append test libraries to include path.
	set_include_path(
		implode(PATH_SEPARATOR,
			array_merge(
				array_filter(explode(PATH_SEPARATOR, get_include_path())),
				$libraries
			)
		)
	);

});

require(__DIR__ . "/../lib/init.php");
require(__DIR__ . "/../testlib/phpunit/phpunit.php");
