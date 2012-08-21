<?php

namespace The86;

use Guzzle\Common\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BearerTokenAuthPlugin implements EventSubscriberInterface
{
    // CurlAuthPlugin uses priority 255.
    // BearerTokenAuthPlugin should be lower-priority so that it can overwrite
    // the basic auth header set by CurlAuthPlugin.
    const PRIORITY = 128;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'command.before_send' => array('onBeforeSend', self::PRIORITY)
        );
    }

    /**
     * Add OAuth 2 bearer token authentication.
     *
     * @param Event $event
     */
    public function onBeforeSend(Event $event)
    {
        $command = $event['command'];
        $request = $command->getRequest();

        if ($command['oauth_token']) {
            $request->setHeader(
                'Authorization',
                'Bearer ' . $command['oauth_token']
            );
        }
    }
}
