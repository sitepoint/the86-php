<?php

namespace The86;

foreach (array(
	"Resource",
	"Site",
	"User",
) as $name) {
	require(__DIR__ . "/The86/$name.php");
}
