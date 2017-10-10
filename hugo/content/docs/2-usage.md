---
title: "Usage"
link: "Usage"
weight: 20
---

From within your PHP application you can access the BambooHR API with just a couple lines:

```php
<?php

require "./vendor/autoload.php";

$bamboo = new BambooHR\BambooHR("BAMBOO COMPANY SUBDOMAIN", "BAMBOO API TOKEN");

// Get the employee directory
$employees = $bamboo->employees->directory();
```