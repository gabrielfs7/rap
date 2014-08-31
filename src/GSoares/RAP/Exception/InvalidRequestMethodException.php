<?php
namespace GSoares\RAP\Exception;

/**
 * @package GSoares\RAP\Exception
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class InvalidRequestMethodException extends RAPException
{
    const CODE = 5;

    /**
     * @param string $methodName
     * @param \Exception $previous
     */
    public function __construct($methodName, \Exception $previous = null)
    {
        parent::__construct('Method "' . $methodName . '" is invalid', $previous);
    }
}
