<?php

namespace The86;

foreach (array(
	"Http",
	"Resource",
	"ResourceCollection",
	"Conversation",
	"Site",
	"User",
) as $name) {
	require(__DIR__ . "/The86/$name.php");
}
