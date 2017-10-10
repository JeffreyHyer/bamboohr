---
title: "Response"
weight: 32
markup: mmark
---

All calls to the API return an instance of the `BambooHR\Api\Response` class.

The `Response` class has a number of convenient abstractions that make working with
API requests and responses easier including error checking and a standard response format.

{class="table table-striped table-bordered"}
|---
| Method | Return Type | Description |
|---|---|---
| hasErrors() | boolean | Returns `true` if the request resulted in an error or `false` otherwise. The BambooHR API returns errors in the response HTTP headers so this is a convenience method that checks for the existence of the error header(s)
|---
| getErrors() | array | Returns an array of strings that contain the error(s) returned in the response headers
|---
| getCode() | integer | Returns the HTTP status code of the response (e.g. 200 for OK, 403 for Forbidden, etc)
|---
| getReason() | string | Returns the HTTP status text of the response (e.g. "OK", "Forbidden", etc)
|---
| getResponse() | object\|array | Returns the raw JSON-decoded response from the API
|---