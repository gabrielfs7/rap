<?php
namespace Sample;

/**
 * Class Group
 *
 * @package Sample
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
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
     * @var int
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
     * @var GroupCategory
     * @RAP/Property(
     *     "type" => "Sample\GroupCategory",
     *     "name" => "groupCategory",
     *     "required" => true,
     *     "help" => "Group Category"
     * )
     */
    public $groupCategory;

    /**
     * @var Status
     * @RAP/Property(
     *     "type" => "Sample\Status",
     *     "name" => "status",
     *     "required" => true,
     *     "help" => "Group Status"
     * )
     */
    private $status;

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }
}
