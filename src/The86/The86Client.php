<?php

namespace The86;

use Guzzle\Service\Client;
use Guzzle\Service\Inspector;
use Guzzle\Service\Description\ServiceDescription;

class The86Client extends Client
{
	protected $username;
	protected $password;

    /**
     * Factory method to create a new The86Client
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL, composed of scheme and domain by default.
	 *    scheme   - https, perhaps http for dev/testing.
	 *  * username - API username.
	 *  * password - API password.
     *
     * @return The86Client
     */
    public static function factory($config = array())
    {
		$default = array(
			'base_url' => '{scheme}://{domain}/api/v1/',
			'scheme' => 'https',
		);
        $required = array('domain', 'username', 'password');
        $config = Inspector::prepareConfig($config, $default, $required);

		$client = new self(
			$config->get('base_url'),
			$config->get('username'),
			$config->get('password')
		);

        $client->setConfig($config);

        return $client;
    }

	public function __construct($baseUrl, $username, $password)
	{
		parent::__construct($baseUrl);
		$this->username = $username;
		$this->password = $password;
	}
}
