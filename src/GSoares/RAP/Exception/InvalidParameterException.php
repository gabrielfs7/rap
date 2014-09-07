<?php
namespace GSoares\RAP\Exception;

/**
 * @package GSoares\RAP\Exception
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class InvalidParameterException extends RAPException
{
    const CODE = 10;

    /**
     * @param string $paramName
     * @param string $paramValue
     * @param \Exception $previous
     */
    public function __construct($paramName, $paramValue, \Exception $previous = null)
    {
        parent::__construct(
            'Parameter "' . $paramName . '" with invalid value "' . strval($paramValue) . '"', $previous
        );
    }
}
