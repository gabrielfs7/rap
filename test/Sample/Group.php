<?php
namespace Sample;

class Group
{
    /**
     * @var string
     * @RAP/Property(
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
     * @RAP/Property(
     *     "type" => "integer",
     *     "name" => "members",
     *     "required" => true,
     *     "help" => "Total Group members",
     *     "sample" => 777
     * )
     */
    public $members;

    /**
     * @var string
     * @RAP/Property(
     *     "type" => "Sample\GroupCategory[]",
     *     "name" => "groupCategory",
     *     "required" => true,
     *     "help" => "Group Category"
     * )
     */
    public $groupCategory;
}
