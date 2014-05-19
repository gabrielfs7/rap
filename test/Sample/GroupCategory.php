<?php
namespace Sample;

class GroupCategory
{
    /**
     * @var string
     * @RAP/Property(
     *     "type" => "string",
     *     "name" => "code",
     *     "required" => true,
     *     "help" => "Group Category Code",
     *     "sample" => "1"
     * )
     */
    public $code;

    /**
     * @var string
     * @RAP/Property(
     *     "type" => "string",
     *     "name" => "name",
     *     "required" => true,
     *     "help" => "Group Category name",
     *     "sample" => "Programing"
     * )
     */
    public $name;
}
