<?php
namespace GSoares\RAP\Exception;

/**
 * @package GSoares\RAP\Exception
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RequiredParameterMissingException extends RAPException
{
    const CODE = 7;

    /**
     * @param string $paramName
     * @param \Exception $previous
     */
    public function __construct($paramName, \Exception $previous = null)
    {
        parent::__construct('Required parameter "' . $paramName . '" is missing', $previous);
    }
}
