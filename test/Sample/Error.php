<?php
namespace Sample;

class Error
{
    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "string",
     *     "name" => "message",
     *     "required" => true,
     *     "help" => "Error Message",
     *     "sample" => "Property XXX invalid"
     * )
     */
    public $message;
}