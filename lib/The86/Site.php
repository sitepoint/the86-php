<?php

namespace The86;

class Site extends Resource
{
	public static $path = 'sites';

	/**
	 * Site URL uses slug instead of id.
	 */
	public function pathParameter()
	{
		return $this->slug;
	}

	/**
	 * Child collection of conversations.
	 */
	public function conversations()
	{
		return $this->collection("conversations", "The86\Conversation");
	}
}
