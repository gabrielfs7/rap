<?php
namespace GSoares\RAP\Document;
use GSoares\RAP\Exception\ErrorHandler;

/**
 * @package GSoares\RAP\Document
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Documentor
{
    const BOOTSTRAP_CSS_URL = 'cssUrl';
    const BOOTSTRAP_RESPONSIVE_CSS_URL = 'responsiveCssUrl';
    const BOOTSTRAP_JAVASCRIPT_URL = 'javascriptUrl';
    const JQUERY_URL = 'jqueryUrl';

    /**
     * @var array
     */
    private static $classes = [];

    /**
     * @var array
     */
    private static $config = [
        self::BOOTSTRAP_CSS_URL => 'http://getbootstrap.com/dist/css/bootstrap.min.css',
        self::BOOTSTRAP_RESPONSIVE_CSS_URL => 'http://getbootstrap.com/2.3.2/assets/css/bootstrap-responsive.css',
        self::BOOTSTRAP_JAVASCRIPT_URL => 'http://getbootstrap.com/dist/js/bootstrap.min.js',
        self::JQUERY_URL => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'
    ];

    /**
     * @param string $class
     * @param string $presentation
     */
    public static function addClass($class, $presentation)
    {
        self::$classes[$class] = $presentation;

        asort(self::$classes);
    }

    /**
     * @return string[]
     */
    public static function getClasses()
    {
        return self::$classes;
    }

    /**
     * @param $cssUrl
     * @param $responsiveCssUrl
     * @param $javascriptUrl
     * @param $jqueryUrl
     */
    public static function configBootstrapResource($cssUrl, $responsiveCssUrl, $javascriptUrl, $jqueryUrl)
    {
        self::$config['bootstrap'] = [
            self::BOOTSTRAP_CSS_URL => $cssUrl,
            self::BOOTSTRAP_RESPONSIVE_CSS_URL => $responsiveCssUrl,
            self::BOOTSTRAP_JAVASCRIPT_URL => $javascriptUrl,
            self::JQUERY_URL => $jqueryUrl
        ];
    }

    /**
     * @param string $configIndex
     * @return string
     */
    public static function getConfig($configIndex)
    {
        return isset(self::$config[$configIndex]) ? self::$config[$configIndex] : null;
    }

    /**
     * @return string
     */
    public static function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * @return string
     */
    public static function document()
    {
        ErrorHandler::register();

        $classesDoc = (new DocumentFactory())->create(self::$classes);

        ob_start();

        include realpath(__DIR__ . '/../../../../template/apidoc.php');

        return ob_get_clean();
    }
}