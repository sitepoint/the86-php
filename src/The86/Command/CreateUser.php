<?php

namespace The86\Command;

/**
 * @guzzle attributes doc="User attributes, e.g. name" required="true" type="array"
 */
class CreateUser extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->client->post(
            'users',
            null,
            json_encode($this->data['attributes'])
        );
    }
}
