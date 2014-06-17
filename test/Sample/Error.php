<?php
namespace Sample;

/**
 * Class Error
 *
 * @package Sample
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Error
{
    /**
     * @var string
     * @RAP/Property(
     *     "type" => "string",
     *     "name" => "message",
     *     "required" => true,
     *     "help" => "Error Message",
     *     "sample" => "Property XYZ invalid"
     * )
     */
    public $message;
}