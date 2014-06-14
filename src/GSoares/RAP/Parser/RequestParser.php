<?php
namespace GSoares\RAP\Parser;

use GSoares\RAP\Map\Param;
use GSoares\RAP\Map\Resource;
use GSoares\RAP\Request\ParamRequestValidator;
use GSoares\RAP\Request\RequestValidatorInterface;
use GSoares\RAP\Request\ResourceRequestValidator;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestParser
 * @package GSoares\RAP\Parser
 */
class RequestParser implements RequestParserInterface
{
    /**
     * @var AnnotationParserInterface
     */
    private $annotationParser;

    /**
     * @var RequestValidatorInterface
     */
    private $resourceValidator;

    /**
     * @var RequestValidatorInterface
     */
    private $paramValidator;

    /**
     * @param AnnotationParserInterface $annotationParser
     * @param RequestValidatorInterface $resourceValidator
     * @param RequestValidatorInterface $paramValidator
     */
    public function __construct(
        AnnotationParserInterface $annotationParser = null,
        RequestValidatorInterface $resourceValidator = null,
        RequestValidatorInterface $paramValidator = null
    ) {
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
        $this->resourceValidator = $resourceValidator ?: new ResourceRequestValidator();
        $this->paramValidator = $paramValidator ?: new ParamRequestValidator();
    }

    public function parse($method, Request $request)
    {
        $data = $this->validateMethod($method);

        $maps = $this->annotationParser->parse($this->getDocComment($data[0], $data[1]));

        $out = [];

        foreach ($maps as $map) {
            if ($map instanceof Resource) {
                $this->resourceValidator->validate($map, $request);
            }

            if ($map instanceof Param) {
                $out[$map->getName()] = $this->paramValidator->validate($map, $request);
            }
        }

        return $out;
    }

    /**
     * @param $class
     * @param $method
     * @return string
     */
    private function getDocComment($class, $method)
    {
        return (new \ReflectionClass($class))->getMethod($method)->getDocComment();
    }

    /**
     * @param $method
     * @return array
     * @throws \InvalidArgumentException
     */
    private function validateMethod($method)
    {
        list ($class, $method) = explode('::', $method);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Class '$class' does not exists'");
        }

        if (!method_exists($class, $method)) {
            throw new \InvalidArgumentException("Method '$class::$method' does not exists'");
        }

        return [$class, $method];
    }
}