# Stream Zend

[![Build Status](https://travis-ci.org/GetStream/stream-zend.svg?branch=master)](https://travis-ci.org/GetStream/stream-zend)
[![Code Coverage](https://scrutinizer-ci.com/g/GetStream/stream-zend/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GetStream/stream-zend/)
[![Code Quality](https://scrutinizer-ci.com/g/GetStream/stream-zend/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GetStream/stream-zend/)
[![Latest Stable Version](https://poser.pugx.org/get-stream/stream-zend/v/stable)](https://packagist.org/packages/get-stream/stream-zend)
[![License](https://poser.pugx.org/get-stream/stream-zend/license)](https://packagist.org/packages/get-stream/stream-zend)

[stream-zend](https://github.com/GetStream/stream-zend) is a package that sets up a [GetStream](https://getstream.io/) client in your Zend Framework application.

You can sign up for a Stream account at [https://getstream.io/get_started](https://getstream.io/get_started).

Note there is also a lower level [PHP - Stream integration](https://github.com/getstream/stream-php) library which is suitable for all PHP applications.

## Build Activity Streams, News Feeds, and More

![](https://dvqg2dogggmn6.cloudfront.net/images/mood-home.png)

You can build:

* Activity Streams - like the one seen on GitHub
* A Twitter-like feed
* Instagram / Pinterest Photo Feeds
* Facebook-style newsfeeds
* A Notification System
* Lots more...

## Installation

### Composer

```
composer require get-stream/stream-zend
```

Composer will install our latest stable version automatically.

### PHP compatibility

Current releases require PHP `5.6` or higher.

See the [Travis configuration](.travis.yml) for details of how it is built and tested against different PHP versions.

### Zend framework configuration

This package contains a Zend Framework module, so you'll have to add `GetStream\Zend` to your application's
`config/modules.config.php` file for it to be loaded whenever your application boots.

Next add a file to `config/autoload` directory (for example, call it `stream.local.php`) and copy paste
the content of [this file](config/stream.local.php), and modify it to your needs. Keep either
the `url` config variable (useful in Heroku environments), or the `app_key` and `app_secret`.

```php
<?php

return [
    'stream' => [
        // Heroku connection url:
        'url' => getenv('STREAM_URL'),

        // Just regular key and secret found in your app dashboard: https://getstream.io/dashboard
        'app_key' => getenv('STREAM_APP_KEY'),
        'app_secret' => getenv('STREAM_APP_SECRET'),
    ],
];
```

Now you're done! You can inject a configured `GetStream\Stream\Client` object anywhere in your Zend application using the
service container:

```php
$client = $container->get(GetStream\Stream\Client::class);
```

## GetStream.io Dashboard

Now, login to [GetStream.io](https://getstream.io) and create an application in the dashboard.

Retrieve the API key, API secret, and API app id, which are shown in your dashboard.

### Copyright and License Information

Copyright (c) 2014-2017 Stream.io Inc, and individual contributors. All rights reserved.

See the file "LICENSE" for information on the history of this software, terms & conditions for usage, and a DISCLAIMER OF ALL WARRANTIES.
