<?php

namespace The86;

class Site extends Resource
{
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
		return $this->_collection("conversations", "The86\Conversation");
	}
}
