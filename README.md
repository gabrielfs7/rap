RAP!
=============

RAP! "Rest API for PHP" provides a very simple way to generate Json Documentation based on your PHP classes and validate your API requests.

### DTOs with docs

DTOs classes with non and sample value.

```php
<?php
namespace Sample;

class RestService
{
    /**
     * @var string
     * @RAP/Resource(
     *     "method" => "GET",
     *     "uri" => "api/user/{id}",
     *     "help" => "Resource to get (teste) user"
     * )
     * @RAP/Param(
     *     "name" => "token",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "ABC123",
     *     "help" => "The authentication token",
     *     "required" => true
     * )
     * @RAP/Param(
     *     "name" => "username",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "JohnSmith",
     *     "help" => "The user name to search",
     *     "required" => true
     * )
     * @RAP/Param(
     *     "name" => "registryDate",
     *     "type" => "date",
     *     "help" => "The user registration date"
     * )
     * @RAP/Response(
     *     "status" => "200",
     *     "return" => "Sample\User[]",
     *     "help" => "Returns the user in case of success"
     * )
     * @RAP/Response(
     *     "status" => "400",
     *     "return" => "Sample\Error[]",
     *     "help" => "A list of errors if request fail"
     * )
     * @RAP/Response(
     *     "status" => "500",
     *     "return" => "string",
     *     "help" => "Internal server error"
     * )
     * @param int Does not care...
     * @return mixed Does not care...
     */
    public function get() {}

    /**
     * @RAP/Resource(
     *     "method" => "PUT",
     *     "uri" => "api/user/{id}",
     *     "help" => "Resource to update user"
     * )
     * @RAP/Param(
     *     "name" => "token",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "ABC123",
     *     "help" => "The authentication token",
     *     "required" => true
     * )
     * @RAP/Param(
     *     "name" => "user",
     *     "type" => "Sample\User",
     *     "help" => "The user to update",
     *     "required" => true
     * )
     * @RAP/Response(
     *     "status" => "200",
     *     "return" => "Sample\User[]",
     *     "help" => "Returns the user in case of success"
     * )
     * @RAP/Response(
     *     "status" => "400",
     *     "return" => "Sample\Error[]",
     *     "help" => "A list of errors if request fail"
     * )
     * @param int Does not care...
     * @return mixed Does not care...
     */
    public function put() {}

    /**
     * @RAP/Resource(
     *     "method" => "POST",
     *     "uri" => "api/user",
     *     "help" => "Resource to create user"
     * )
     * @RAP/Param(
     *     "name" => "token",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "ABC123",
     *     "help" => "The authentication token",
     *     "required" => true
     * )
     * @RAP/Param(
     *     "name" => "user",
     *     "type" => "Sample\User",
     *     "help" => "The user to update",
     *     "required" => true
     * )
     * @RAP/Response(
     *     "status" => "200",
     *     "return" => "Sample\User[]",
     *     "help" => "Returns the user created"
     * )
     * @RAP/Response(
     *     "status" => "400",
     *     "return" => "Sample\Error[]",
     *     "help" => "A list of errors if request fail"
     * )
     * @param int Does not care...
     * @return mixed Does not care...
     */
    public function post() {}
}
?>
```

### Output

A documentation example for the code above for the GET resource

<pre>
REQUEST:

{
  "token": "ABC123",
  "username": "JohnSmith",
  "registryDate": "2014-05-18"
}

RESPONSE:

{
  "name": "John",
  "age": 18,
  "birthDate": "1969-01-01",
  "status": {
    "code": "1",
    "name": "Active"
  },
  "groups": [
    {
      "name": "PHP Fans",
      "members": 777,
      "groupCategory": [
        {
          "code": "1",
          "name": "Programing"
        }
      ]
    }
  ]
}
</pre>
