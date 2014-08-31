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
        register_shutdown_function(
            function ()
            {
                if ($error = error_get_last()) {
                    throw new \ErrorException(
                        $error['message'],
                        0,
                        $error['type'],
                        $error['file'],
                        $error['line']
                    );
                }
            }
        );

        set_error_handler(
            function ($severity, $message, $fileName, $lineNumber)
            {
                throw new \ErrorException($message, 0, $severity, $fileName, $lineNumber);
            }
        );
    }
}