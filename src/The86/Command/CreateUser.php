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
            array('Content-Type' => 'application/json; charset=utf-8'),
            json_encode($this->data['attributes'])
        );
    }
}
