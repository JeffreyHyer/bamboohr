---
title: "Employees"
weight: 33
markup: mmark
---

*See the BambooHR documentation relating to employees here: https://www.bamboohr.com/api/documentation/employees.php*

Can be accessed via any of the following aliases:
- employee
- employees

-----

#### me($fields = null)

<br>

Returns the current user as determined by the API key used for the request.

_This is an alias/shortcut for calling:_ `$bamboo->employees->byId(0, $fields)`

__Request__

```php
<?php

// Defaults to all fields
$bamboo->employees->me();

// -OR-

// Specify which fields to return
$bamboo->employees->me(['firstName', 'lastName']);
```

__Response__

```php
<?php

BambooHR\Api\Response Object
(
    [code:protected] => 200
    [reason:protected] => OK
    [errors:protected] => Array
        (
        )

    [response:protected] => stdClass Object
        (
            [id] => 123
            [address1] => 123 North Main St
            [address2] => 
            [age] => 25
            [bestEmail] => test@yourcompany.com
            [birthday] => 12-25
            [city] => Lindon
            [country] => 
            [dateOfBirth] => 1901-01-01
            [department] => 
            [division] => 
            [eeo] => 
            [employeeNumber] => 123456
            [employmentHistoryStatus] => Full-Time
            [ethnicity] => 
            [flsaCode] => Exempt
            [firstName] => John
            [fullName1] => John Doe
            [fullName2] => Doe, John
            [fullName3] => Doe, John B 
            [fullName4] => Doe, John B
            [fullName5] => John B Doe
            [displayName] => John Doe
            [gender] => Male
            [hireDate] => 2000-01-01
            [originalHireDate] => 0000-00-00
            [homeEmail] => john@yourcompany.com
            [homePhone] => 555-123-4567
            [jobTitle] => Job Title
            [lastChanged] => 2001-01-01T12:34:56+00:00
            [lastName] => Doe
            [location] => Utah
            [maritalStatus] => Married
            [middleName] => B
            [mobilePhone] => 
            [payChangeReason] => 
            [payGroupId] => 
            [payRate] => 123456.00 USD
            [payRateEffectiveDate] => 2000-01-01
            [payType] => Salary
            [payPer] => Year
            [payPeriod] => Every other week
            [preferredName] => 
            [ssn] => 
            [state] => UT
            [stateCode] => UT
            [status] => Active
            [supervisor] => Jane Doe
            [supervisorId] => 123457
            [supervisorEId] => 124
            [terminationDate] => 0000-00-00
            [workEmail] => 
            [workPhone] => 
            [workPhonePlusExtension] => 
            [workPhoneExtension] => 
            [zipcode] => 12345
            [isPhotoUploaded] => false
        )

)
```

-----

#### byId($id, $fields = null)

<br>

Returns the user identified by `$id`

__Request__

```php
<?php

// Defaults to all fields
$bamboo->employees->byId(123);

// -OR-

// Specify which fields to return
$bamboo->employees->byId(123, ['firstName', 'lastName']);
```

__Response__

```php
<?php

BambooHR\Api\Response Object
(
    [code:protected] => 200
    [reason:protected] => OK
    [errors:protected] => Array
        (
        )

    [response:protected] => stdClass Object
        (
            [id] => 123
            [address1] => 123 North Main St
            [address2] => 
            [age] => 25
            [bestEmail] => test@yourcompany.com
            [birthday] => 12-25
            [city] => Lindon
            [country] => 
            [dateOfBirth] => 1901-01-01
            [department] => 
            [division] => 
            [eeo] => 
            [employeeNumber] => 123456
            [employmentHistoryStatus] => Full-Time
            [ethnicity] => 
            [flsaCode] => Exempt
            [firstName] => John
            [fullName1] => John Doe
            [fullName2] => Doe, John
            [fullName3] => Doe, John B 
            [fullName4] => Doe, John B
            [fullName5] => John B Doe
            [displayName] => John Doe
            [gender] => Male
            [hireDate] => 2000-01-01
            [originalHireDate] => 0000-00-00
            [homeEmail] => john@yourcompany.com
            [homePhone] => 555-123-4567
            [jobTitle] => Job Title
            [lastChanged] => 2001-01-01T12:34:56+00:00
            [lastName] => Doe
            [location] => Utah
            [maritalStatus] => Married
            [middleName] => B
            [mobilePhone] => 
            [payChangeReason] => 
            [payGroupId] => 
            [payRate] => 123456.00 USD
            [payRateEffectiveDate] => 2000-01-01
            [payType] => Salary
            [payPer] => Year
            [payPeriod] => Every other week
            [preferredName] => 
            [ssn] => 
            [state] => UT
            [stateCode] => UT
            [status] => Active
            [supervisor] => Jane Doe
            [supervisorId] => 123457
            [supervisorEId] => 124
            [terminationDate] => 0000-00-00
            [workEmail] => 
            [workPhone] => 
            [workPhonePlusExtension] => 
            [workPhoneExtension] => 
            [zipcode] => 12345
            [isPhotoUploaded] => false
        )

)
```

-----

#### directory()

<br>

Returns the employee directory

__Request__

```php
<?php

$bamboo->employees->directory();
```

__Response__

```php
<?php

// TODO
BambooHR\Api\Response Object
(
    [code:protected] => 200
    [reason:protected] => OK
    [errors:protected] => Array
        (
        )

    [response:protected] => stdClass Object
        (
        )

)
```

-----

#### add(array $data)

<br>

Add a new employee

See: https://www.bamboohr.com/api/documentation/employees.php#addEmployee

__Parameters__

{class="table table-bordered"}
|---
| Parameter | Type | Required | Description
|---|---|:---:|---
| $data | Array | :white_check_mark: | Data describing the employee to be created. `firstName` and `lastName` are the only required fields.
|---

__Request__

```php
<?php

$data = [
    'firstName' => 'John',
    'lastName'  => 'Doe'
];

$bamboo->employees->add($data);
```

__Response__

```php
<?php

// TODO
BambooHR\Api\Response Object
(
    [code:protected] => 200
    [reason:protected] => OK
    [errors:protected] => Array
        (
        )

    [response:protected] => stdClass Object
        (
        )

)
```

-----

#### update(string $id, array $data)

<br>

Edit/update an existing employee

See: https://www.bamboohr.com/api/documentation/employees.php#updateEmployee

__Parameters__

{class="table table-bordered"}
|---
| Parameter | Type | Required | Description
|---|---|:---:|---
| $id | Mixed (String) | :white_check_mark: | The employee ID to update
|---
| $data | Array | :white_check_mark: | The data to set on the employee
|---

__Request__

```php
<?php

$data = [
    'firstName' => 'Joe',
    'lastName'  => 'Schmo',
];

$bamboo->employees->update('123', $data);
```

__Response__

```php
<?php

// TODO
BambooHR\Api\Response Object
(
    [code:protected] => 200
    [reason:protected] => OK
    [errors:protected] => Array
        (
        )

    [response:protected] => stdClass Object
        (
        )

)
```

-----

#### files(string $id)

<br>

Get a list of files associated with the given employee

See: https://www.bamboohr.com/api/documentation/employees.php#listEmployeeFiles

__Parameters__

{class="table table-bordered"}
|---
| Parameter | Type | Required | Description
|---|---|:---:|---
| $id | Mixed (String) | :white_check_mark: | An employee ID
|---

__Request__

```php
<?php

$bamboo->employee->files(123);
```

__Response__

```php
<?php

// TODO
BambooHR\Api\Response Object
(
    [code:protected] => 200
    [reason:protected] => OK
    [errors:protected] => Array
        (
        )

    [response:protected] => stdClass Object
        (
        )

)
```

-----