# BambooHR PHP SDK

This repository contains a PHP SDK for use with the
[BambooHR](https://bamboohr.com/) API.

If you're looking to use this package inside a [Laravel](https://laravel.com/) application
you may want to check out this package instead: [jeffreyhyer/bamboohr-laravel](https://github.com/jeffreyhyer/bamboohr-laravel).
It wraps this package in a Service Provider and provides access via a Facade so the API is the
same but you'll write less code and get the same results :+1:

**DISCLAIMER:** This is **NOT** an official SDK, it is not affiliated with nor
endorsed by BambooHR in any way.


## Installation

> __NOTE__: This package currently requires PHP >= 7.0.0
>
> If you have a need for PHP 5.x support let me know by opening an issue (or feel free to submit a pull request).

#### Via Composer

```shell
$ composer require jeffreyhyer/bamboohr
```

Or add the following to your `composer.json` file:
```json
{
    "require": {
        "jeffreyhyer/bamboohr": "~1.0.6"
    }
}
```

From within the same directory as your `composer.json` file execute:

```shell
$ composer install
```

In your PHP file (if you're not using a fancy framework that handles autoloading
for you):

```php
<?php

require './vendor/autoload.php';
```


## Usage

From within your PHP application you can access the BambooHR API with just a
couple lines:

```php
<?php

require './vendor/autoload.php';

use BambooHR\BambooHR;

$api_token = "[BAMBOOHR API TOKEN]";
$company = "[BAMBOO COMPANY NAME]";

$bamboo = new BambooHR($company, $api_token);

// Get the employee directory
$employees = $bamboo->employees->directory();
```