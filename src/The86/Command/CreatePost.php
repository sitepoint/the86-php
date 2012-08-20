<?php

namespace The86\Command;

/**
 * @guzzle site doc="Site slug" required="true"
 * @guzzle conversation doc="Conversation ID" required="true"
 * @guzzle attributes doc="Post attributes, e.g. content" required="true" type="array"
 */
class CreatePost extends \Guzzle\Service\Command\AbstractCommand
{
	public function build()
	{
        $this->request = $this->client->post(
            array('sites/{site}/conversations/{conversation}/posts', $this->data),
            $this->data['attributes']
		);
	}
}
