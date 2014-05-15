<?php
namespace Sample;

class Group
{
    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "string",
     *     "name" => "name",
     *     "required" => true,
     *     "help" => "Group name",
     *     "sample" => "PHP Fans"
     * )
     */
    public $name;

    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "integer",
     *     "name" => "members",
     *     "required" => true,
     *     "help" => "Total Group members",
     *     "sample" => 777
     * )
     */
    public $members;
}
