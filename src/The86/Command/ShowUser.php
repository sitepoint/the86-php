<?php

namespace The86\Command;

/**
 * @guzzle user doc="The user ID." required="true"
 */
class ShowUser extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->client->get(
            array('users/{user}', $this->data)
        );
    }
}
