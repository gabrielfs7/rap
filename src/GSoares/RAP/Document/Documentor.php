<?php
namespace GSoares\RAP\Document;

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
        self::BOOTSTRAP_CSS_URL => 'http://getbootstrap.com/2.3.2/assets/css/bootstrap.css',
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
     * @param string $cssUrl
     * @param string $responsiveCssUrl
     * @param string $javascriptUrl
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
     * @return mixed
     */
    public static function getConfig($configIndex)
    {
        return isset(self::$config[$configIndex]) ? self::$config[$configIndex] : null;
    }

    public static function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * @return string
     */
    public static function document()
    {
        ob_start();
        include realpath(__DIR__ . '/../../../../template/apidoc.php');
        return ob_get_clean();
    }
}