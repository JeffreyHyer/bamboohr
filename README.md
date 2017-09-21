# BambooHR PHP SDK

This repository contains a PHP SDK for use with the
[BambooHR](https://bamboohr.com/) API.

**DISCLAIMER:** This is **NOT** an official SDK, it is not affiliated with nor
endorsed by BambooHR in any way. Use at your own risk.


## Installation

#### Via Composer

```shell
$ composer require jeffreyhyer/bamboohr
```

Or add the following to your `composer.json` file:
```json
{
    "require": {
        "jeffreyhyer/bamboohr": "~0.1.0"
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