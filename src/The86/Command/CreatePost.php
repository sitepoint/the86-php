<?php

namespace The86\Command;

/**
 * @guzzle site doc="Site slug" required="true"
 * @guzzle conversation doc="Conversation ID" required="true"
 * @guzzle attributes doc="Post attributes, e.g. content" required="true" type="array"
 * @guzzle oauth_token doc="OAuth 2 bearer token." required="true"
 */
class CreatePost extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->client->post(
            array('sites/{site}/conversations/{conversation}/posts', $this->data),
            null,
            json_encode($this->data['attributes'])
        );
    }
}
