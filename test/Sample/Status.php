<?php
namespace Sample;

/**
 * Class Status
 *
 * @package Sample
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Status
{
    /**
     * @var string
     * @RAP/Property(
     *     "type" => "string",
     *     "name" => "code",
     *     "required" => true,
     *     "help" => "Status Code",
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
     *     "help" => "Status name",
     *     "sample" => "Active"
     * )
     */
    public $name;
}
