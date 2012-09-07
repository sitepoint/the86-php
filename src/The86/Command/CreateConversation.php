<?php

namespace The86\Command;

/**
 * @guzzle site doc="Site slug" required="true"
 * @guzzle attributes doc="Conversation attributes, e.g. content" required="true" type="array"
 * @guzzle oauth_token doc="OAuth 2 bearer token." required="true"
 */
class CreateConversation extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->client->post(
            array('sites/{site}/conversations', $this->data),
            array('Content-Type' => 'application/json; charset=utf-8'),
            json_encode($this->data['attributes'])
        );
    }
}
