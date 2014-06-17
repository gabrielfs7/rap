<?php
namespace GSoares\RAP\Exception;

/**
 * Class RAPException
 *
 * @package GSoares\RAP\Exception
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RAPException extends \Exception
{
    const CODE_PREFIX = 100;
    const CODE = 1;

    /**
     * @param string $message
     * @param \Exception $previous
     */
    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct('RAP ERROR: ' . $message, self::CODE_PREFIX . static::CODE, $previous);
    }
}