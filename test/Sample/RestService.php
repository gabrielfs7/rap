<?php
namespace Sample;

class RestService
{
    /**
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