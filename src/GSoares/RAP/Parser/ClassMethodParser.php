<?php
namespace GSoares\RAP\Parser;

/**
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ClassMethodParser
{

    /**
     * @var AnnotationParserInterface
     */
    private $annotationParser;

    /**
     * @param AnnotationParserInterface $annotationParser
     */
    public function __construct(AnnotationParserInterface $annotationParser = null)
    {
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
    }

    /**
     * @param string $method
     * @return \GSoares\RAP\Map\MapInterface[]
     * @throws \InvalidArgumentException
     */
    public function parse($method)
    {
        list ($class, $method) = explode('::', $method);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException("Class '$class' does not exists'");
        }

        if (!method_exists($class, $method)) {
            throw new \InvalidArgumentException("Method '$class::$method' does not exists'");
        }

        return $this->annotationParser->parse((new \ReflectionClass($class))->getMethod($method)->getDocComment());
    }
}