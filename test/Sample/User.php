<?php
namespace Sample;

class User
{
    /**
     * @var string
     * @EasyJsonDoc\Sample John Smith
     */
    public $name;

    /**
     * @var int
     * @EasyJsonDoc\Sample 33
     */
    public $age;

    /**
     * @var datetime
     */
    public $birthDate;

    /**
     * @var Sample\Status
     */
    public $status;

    /**
     * @var Sample\Group[]
     */
    public $groups;
}