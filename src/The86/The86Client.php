<?php

namespace The86;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\ServiceDescription;

class The86Client extends Client
{
    /**
     * Factory method to create a new The86Client
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *
     * @return The86Client
     *
     * @TODO update factory method and docblock for parameters
     */
    public static function factory($config)
    {
        $default = array();
        $required = array('base_url');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('base_url'));
        $client->setConfig($config);

        // Uncomment the following two lines to use an XML service description
        // $client->setDescription(ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'client.xml'));

        return $client;
    }
}
