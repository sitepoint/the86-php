the86-php
=========

PHP client library for “The 86” conversation API server.

Uses:

* [Guzzle](http://guzzlephp.org/) for HTTP transport, JSON decoding etc.
* [PHPUnit](http://www.phpunit.de/) for testing.
* [Composer](http://getcomposer.org/) for dependency management.


Usage
-----

```php
// Get a configured client.
$client = The86\The86Client::factory(array(
  'domain' => 'the86.example.org',
  'username' => 'your-site-username',
  'password' => 'your-site'password',
));

// List all conversations for a site.
$conversations = $client->getCommand('ListConversations', array(
  'site' => 'example',
))->execute();

// List all recent conversations/posts for a site.
$conversations = $client->getCommand('ListConversations', array(
  'site' => 'example',
  'parameters' => array(
    'site' => 'example',
    'posts_since' => '2012-08-08T03:26:52Z',
  )
))->execute();
```


Development & Testing
---------------------

You'll need Composer. You can grab a local copy quickly like this:

    curl -s https://getcomposer.org/installer | php

Use composer to install the dependencies:

    php composer.phar install --dev

If you don't want to install PHPUnit system-wide, you can clone it to a
git-ignored subdirectory of this project (installer requires Ruby 1.9+):

    ./tests/install.rb

… and run the tests using this wrapper which configures the include paths:

    ./tests/run.php


Licence
-------

(c) SitePoint, 2012, MIT license.
