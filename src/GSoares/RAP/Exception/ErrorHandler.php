<?php
namespace GSoares\RAP\Exception;

/**
 * @package GSoares\RAP\Exception
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ErrorHandler
{

    public static function register()
    {
        set_error_handler([__CLASS__, 'handle']);
    }

    /**
     * @param $severity
     * @param $message
     * @param $fileName
     * @param $lineNumber
     * @throws \ErrorException
     */
    public static function handle($severity, $message, $fileName, $lineNumber)
    {
        throw new \ErrorException($message, 0, $severity, $fileName, $lineNumber);
    }
}