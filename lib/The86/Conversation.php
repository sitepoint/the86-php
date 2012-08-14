<?php

namespace The86;

class Conversation extends Resource
{
	public static $path = 'conversations';

	public function posts()
	{
		return $this->collection("posts", "The86\Post");
	}
}
