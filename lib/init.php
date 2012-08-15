<?php

namespace The86;

foreach (array(
	"Http",
	"Resource",
	"ResourceCollection",
	"ApiRoot",
	"Conversation",
	"Post",
	"Site",
	"User",
) as $name) {
	require(__DIR__ . "/The86/$name.php");
}
