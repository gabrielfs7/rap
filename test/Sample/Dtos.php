<?php
namespace Sample;

class User
{
    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "string",
     *     "name" => "name",
     *     "required" => true,
     *     "help" => "User name",
     *     "sample" => "John"
     * )
     */
    public $name;

    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "integer",
     *     "name" => "age",
     *     "required" => true,
     *     "help" => "User age",
     *     "sample" => 18
     * )
     */
    public $age;

    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "date",
     *     "name" => "birthDate",
     *     "required" => true,
     *     "help" => "User BirthDate",
     *     "sample" => "1969-01-01"
     * )
     */
    public $birthDate;

    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "Sample\Status",
     *     "name" => "status",
     *     "required" => true,
     *     "help" => "User status"
     * )
     */
    public $status;

    /**
     * @var string
     * @EasyJsonDoc/Property(
     *     "type" => "Sample\Group[]",
     *     "name" => "groups",
     *     "required" => true,
     *     "help" => "User groups"
     * )
     */
    public $groups;
}

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

class Error
{
    public $message;
}