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
 *
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
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
     * @var ClassMethodParser
     */
    private $classMethodParser;

    /**
     * @param AnnotationParserInterface $annotationParser
     * @param RequestValidatorInterface $resourceValidator
     * @param RequestValidatorInterface $paramValidator
     * @param ClassMethodParser $classMethodParser
     */
    public function __construct(
        AnnotationParserInterface $annotationParser = null,
        RequestValidatorInterface $resourceValidator = null,
        RequestValidatorInterface $paramValidator = null,
        ClassMethodParser $classMethodParser = null
    ) {
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
        $this->resourceValidator = $resourceValidator ?: new ResourceRequestValidator();
        $this->paramValidator = $paramValidator ?: new ParamRequestValidator();
        $this->classMethodParser = $classMethodParser ?: new ClassMethodParser();
    }

    /**
     * @param string $method
     * @param Request $request
     * @return array|mixed
     */
    public function parse($method, Request $request)
    {
        $out = [];

        foreach ($this->classMethodParser->parse($method) as $map) {
            if ($map instanceof Resource) {
                $this->resourceValidator->validate($map, $request);
            }

            if ($map instanceof Param) {
                $out[$map->getName()] = $this->paramValidator->validate($map, $request);
            }
        }

        return $out;
    }
}