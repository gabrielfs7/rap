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
    public function get() {}
}