<?php
namespace Sample;

class Status
{
    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "string",
     *     "name" => "name",
     *     "required" => true,
     *     "help" => "Status name",
     *     "sample" => "Active"
     * )
     */
    public $name;
}
