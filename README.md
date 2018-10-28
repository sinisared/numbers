# Perfect Number Challenge #

This is a solution for perfect number challenge using using laravel framework. 

## Setup ##

use **composer install** to install dependencies

## Usage ##

use GET method /api/classify/{integer}

## Response ##

System responds with a JSON message 

```
{"type":"type"}
```

where type is abundant, perfect or deficient

## Invalid parameter ## 

Web service will accept any positive integer, any other value will result with an error message and status code 422.

## Testing ##

Two test classes are provided

* tests/Feature/MathApiControllerTest.php - tests webservice using router and api calls
* tests/Unit/MathApiControllerTest.php - tests done on instance of MathApiController class

## Classes ##

* app/Http/Controller/MathApiController.php - contains complete logic
* app/Http/Excceptions/NotIntegerException.php - custom exception to handle invalid parameter

## Routes ##

* routes/api.php - /api/classify/{integer} route added

 




