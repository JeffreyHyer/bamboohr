---
title: "BambooHR"
weight: 31
---

```php
<?php

$company = "demo";              // Your company's BambooHR subdomain (e.g. http://demo.bamboohr.com/)
$api_key = "0123456789abcdef";  // You API token

$bamboo = new BambooHR\BambooHR($company, $api_key);
```

Once instantiated you have access to all the BambooHR API endpoints through convenient helper
methods or properties. Through the use of PHP's `__get()` and `__call()` so-called "magic" methods
you can access a given API through either it's property or method name or one of a number of aliases.

For example, to access the employee directory you could use any of the following:

```php
<?php

$bamboo->employee->directory();     // 'employee' is a "magic" property

$bamboo->employees->directory();    // 'employees' (plural) is an alias for 'employee'

$bamboo->employee()->directory();   // 'employee()' is a "magic" method

$bamboo->employees()->directory();  // Using the alias again...

...
```