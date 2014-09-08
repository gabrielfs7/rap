<?php
namespace GSoares\RAP\Parser;

use GSoares\RAP\Exception\AnnotationParseException;
use GSoares\RAP\Factory\ParamMappedFactory;
use GSoares\RAP\Factory\ResourceMappedFactory;
use GSoares\RAP\Factory\ResponseMappedFactory;
use GSoares\RAP\Map\Resource;
use GSoares\RAP\Parser\AnnotationInterface as Ai;
use GSoares\RAP\Factory\PropertyMappedFactory;

/**
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class AnnotationParser implements AnnotationParserInterface
{

    /**
     * @var ParamMappedFactory
     */
    private $paramMappedFactory;

    /**
     * @var ResourceMappedFactory
     */
    private $resourceMappedFactory;

    /**
     * @var ResponseMappedFactory
     */
    private $responseMappedFactory;

    /**
     * @var PropertyMappedFactory
     */
    private $propertyMappedFactory;

    /**
     * @param ParamMappedFactory $paramMappedFactory
     * @param PropertyMappedFactory $propertyMappedFactory
     * @param ResourceMappedFactory $resourceMappedFactory
     * @param ResponseMappedFactory $responseMappedFactory
     */
    public function __construct(
        ParamMappedFactory $paramMappedFactory = null,
        PropertyMappedFactory $propertyMappedFactory = null,
        ResourceMappedFactory $resourceMappedFactory = null,
        ResponseMappedFactory $responseMappedFactory = null
    ) {
        $this->paramMappedFactory = $paramMappedFactory ?: new ParamMappedFactory();
        $this->resourceMappedFactory = $resourceMappedFactory ?: new ResourceMappedFactory();
        $this->responseMappedFactory = $responseMappedFactory ?: new ResponseMappedFactory();
        $this->propertyMappedFactory = $propertyMappedFactory ?: new PropertyMappedFactory();
    }

    /**
     * @param string $docComment
     * @return \GSoares\RAP\Map\MapInterface[]
     */
    public function parse($docComment)
    {
        $parts = preg_split('/@/', preg_replace('/(\/\*\*)|(\*\/)|(\* )/', '', $docComment));

        $out = [];

        $resource = null;
        $params = [];

        foreach ($parts as $part) {
            if (strpos($part, Ai::RESOURCE) === 0) {
                $out[] = $resource = $this->resourceMappedFactory->create($this->toArray(Ai::RESOURCE, $part));
            }

            if (strpos($part, Ai::RESPONSE) === 0) {
                $response = $this->responseMappedFactory->create($this->toArray(Ai::RESPONSE, $part));

                $out[] = $response;
            }

            if (strpos($part, Ai::PARAM) === 0) {
                $param = $this->paramMappedFactory->create($this->toArray(Ai::PARAM, $part));

                $params[] = $param;
                $out[] = $param;
            }

            if (strpos($part, Ai::PROPERTY) === 0) {
                $out[] = $this->propertyMappedFactory->create($this->toArray(Ai::PROPERTY, $part));
            }
        }

        if ($resource instanceof Resource) {
            $this->relateUriParams($params, $resource);
        }

        return $out;
    }

    /**
     * @param $annotation
     * @param $part
     * @return mixed|string
     * @throws \GSoares\RAP\Exception\AnnotationParseException
     */
    private function toArray($annotation, $part)
    {
        try {
            $part = preg_replace("/[\n]/", '', $part);
            $part = preg_replace("/ {2,}/", ' ', $part);
            $part = trim(ltrim($part, $annotation));
            $part[0] = '[';
            $part[strlen($part) - 1] = ']';
            $part = eval("return($part);");
        } catch (\Exception $e) {
            throw new AnnotationParseException('Annotation: ' . $annotation . '. Part: ' . $part, $e);
        }

        return $part;
    }

    /**
     * @param array $params
     * @param Resource $resource
     */
    private function relateUriParams(array $params, Resource $resource)
    {
        foreach ($params as $param) {
            if ($resource->isUriParam($param)) {
                $param->setIsUriParam(true);
            }
        }
    }
}