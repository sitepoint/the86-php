<?php

namespace The86\Command;

/**
 * @guzzle attributes doc="User attributes, e.g. name" required="true" type="array"
 */
class CreateUser extends \Guzzle\Service\Command\AbstractCommand
{
	public function build()
	{
        $this->request = $this->client->post(
            'users',
            $this->data['attributes']
		);
	}
}
