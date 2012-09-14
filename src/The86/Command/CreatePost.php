<?php

namespace The86\Command;

/**
 * @guzzle group doc="Group slug" required="true"
 * @guzzle conversation doc="Conversation ID" required="true"
 * @guzzle attributes doc="Post attributes, e.g. content" required="true" type="array"
 * @guzzle oauth_token doc="OAuth 2 bearer token." required="true"
 */
class CreatePost extends AbstractCommand
{
    public function build()
    {
        $this->request = $this->postJson(
            array('groups/{group}/conversations/{conversation}/posts', $this->data),
            $this->data['attributes']
        );
    }
}
