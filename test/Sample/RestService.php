<?php
namespace Sample;

class RestService
{
    /**
     * @EasyJsonDoc/Resource(
     *     "method" => "GET",
     *     "uri" => "api/user/{id}",
     *     "help" => "Resource to get (teste) user"
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "token",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "ABC123",
     *     "help" => "The authentication token",
     *     "required" => true
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "username",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "JohnSmith",
     *     "help" => "The user name to search",
     *     "required" => true
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "registryDate",
     *     "type" => "date",
     *     "help" => "The user registration date"
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "200",
     *     "return" => "Sample\User[]",
     *     "help" => "Returns the user in case of success"
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "400",
     *     "return" => "Sample\Error[]",
     *     "help" => "A list of errors if request fail"
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "500",
     *     "return" => "string",
     *     "help" => "Internal server error"
     * )
     * @param int Does not care...
     * @return mixed Does not care...
     */
    public function get() {}

    /**
     * @EasyJsonDoc/Resource(
     *     "method" => "PUT",
     *     "uri" => "api/user/{id}",
     *     "help" => "Resource to update user"
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "token",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "ABC123",
     *     "help" => "The authentication token",
     *     "required" => true
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "user",
     *     "type" => "Sample\User",
     *     "help" => "The user to update",
     *     "required" => true
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "200",
     *     "return" => "Sample\User[]",
     *     "help" => "Returns the user in case of success"
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "400",
     *     "return" => "Sample\Error[]",
     *     "help" => "A list of errors if request fail"
     * )
     * @param int Does not care...
     * @return mixed Does not care...
     */
    public function put() {}

    /**
     * @EasyJsonDoc/Resource(
     *     "method" => "POST",
     *     "uri" => "api/user",
     *     "help" => "Resource to create user"
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "token",
     *     "type" => "string",
     *     "default" => "Test",
     *     "sample" => "ABC123",
     *     "help" => "The authentication token",
     *     "required" => true
     * )
     * @EasyJsonDoc/Param(
     *     "name" => "user",
     *     "type" => "Sample\User",
     *     "help" => "The user to update",
     *     "required" => true
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "200",
     *     "return" => "Sample\User[]",
     *     "help" => "Returns the user created"
     * )
     * @EasyJsonDoc/Response(
     *     "status" => "400",
     *     "return" => "Sample\Error[]",
     *     "help" => "A list of errors if request fail"
     * )
     * @param int Does not care...
     * @return mixed Does not care...
     */
    public function post() {}
}