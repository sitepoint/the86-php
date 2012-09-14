<?php

namespace The86\Command;

/**
 * @guzzle group doc="Group slug" required="true"
 * @guzzle attributes doc="Conversation attributes, e.g. content" required="true" type="array"
 * @guzzle oauth_token doc="OAuth 2 bearer token." required="true"
 */
class CreateConversation extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->postJson(
            array('groups/{group}/conversations', $this->data),
            $this->data['attributes']
        );
    }
}
