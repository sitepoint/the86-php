<?php

namespace The86\Command;

/**
 * @guzzle site doc="Site slug" required="true"
 * @guzzle attributes doc="Conversation attributes, e.g. content" required="true" type="array"
 */
class CreateConversation extends \Guzzle\Service\Command\AbstractCommand
{
	public function build()
	{
        $this->request = $this->client->post(
            array('sites/{site}/conversations', $this->data),
            $this->data['attributes']
		);
	}
}
