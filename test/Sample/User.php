<?php
namespace Sample;

class User
{
    /**
     * @var string
     * @RAP/Property(
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
     * @RAP/Property(
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
     * @RAP/Property(
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
     * @RAP/Property(
     *     "type" => "Sample\Status",
     *     "name" => "status",
     *     "required" => true,
     *     "help" => "User status"
     * )
     */
    public $status;

    /**
     * @var string
     * @RAP/Property(
     *     "type" => "Sample\Group[]",
     *     "name" => "groups",
     *     "required" => true,
     *     "help" => "User groups"
     * )
     */
    public $groups;
}
