<?php

namespace The86\Command;

/**
 * @guzzle site doc="The site slug." required="true"
 */
class ListConversations extends \Guzzle\Service\Command\AbstractCommand
{
	public function build()
	{
		$this->request = $this->client->get(
			array('sites/{site}/conversations', $this->data)
		);
	}
}
