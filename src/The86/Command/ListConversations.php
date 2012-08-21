<?php

namespace The86\Command;

/**
 * @guzzle site doc="The site slug." required="true"
 * @guzzle parameters doc="URL query parameters." required="false" type="array"
 */
class ListConversations extends \Guzzle\Service\Command\AbstractCommand
{
    public function build()
    {
        $this->request = $this->client->get(
            array('sites/{site}/conversations{?parameters*}', $this->data)
        );
    }
}
