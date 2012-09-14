<?php

namespace The86\Command;

/**
 * @guzzle group doc="The group slug." required="true"
 * @guzzle parameters doc="URL query parameters." required="false" type="array"
 */
class ListConversations extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->client->get(
            array('groups/{group}/conversations{?parameters*}', $this->data)
        );
    }
}
