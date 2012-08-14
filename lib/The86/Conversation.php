<?php

namespace The86;

class Conversation extends Resource
{
	public function posts()
	{
		return $this->_collection("posts", "The86\Post");
	}
}
