<?php

namespace The86;

foreach (array(
	"Http",
	"Resource",
	"ResourceCollection",
	"Site",
	"User",
) as $name) {
	require(__DIR__ . "/The86/$name.php");
}
