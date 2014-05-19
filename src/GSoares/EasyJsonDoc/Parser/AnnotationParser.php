<?php
namespace GSoares\EasyJsonDoc\Parser;

use GSoares\EasyJsonDoc\Factory\ParamMappedFactory;
use GSoares\EasyJsonDoc\Factory\ResourceMappedFactory;
use GSoares\EasyJsonDoc\Factory\ResponseMappedFactory;
use GSoares\EasyJsonDoc\Parser\AnnotationInterface as Ai;
use GSoares\EasyJsonDoc\Factory\PropertyMappedFactory;
use GSoares\EasyJsonDoc\Map\Response;
use GSoares\EasyJsonDoc\Map\Param;

class AnnotationParser
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
     * @return GSoares\EasyJsonDoc\Map\MapInterface[]
     */
    public function parse($docComment)
    {
        $parts = preg_split('/@/', preg_replace('/(\/\*\*)|(\*\/)|(\* )/', '', $docComment));

        $out = [];

        foreach ($parts as $part) {
            if (strpos($part, Ai::RESOURCE) === 0) {
                $out[] = $this->resourceMappedFactory->create($this->toArray(Ai::RESOURCE, $part));
            }

            if (strpos($part, Ai::RESPONSE) === 0) {
                $response = $this->responseMappedFactory->create($this->toArray(Ai::RESPONSE, $part));

                if (!empty($response->getReturn())) {
                    $param = new Param();
                    $param->setType($response->getReturn());

                    $response->addParam($param);
                }

                $out[] = $response;
            }

            if (strpos($part, Ai::PARAM) === 0) {
                $out[] = $this->paramMappedFactory->create($this->toArray(Ai::PARAM, $part));
            }

            if (strpos($part, Ai::PROPERTY) === 0) {
                $out[] = $this->propertyMappedFactory->create($this->toArray(Ai::PROPERTY, $part));
            }
        }

        return $out;
    }

    /**
     * @param string $annotation
     * @param string $part
     * @return array
     */
    private function toArray($annotation, $part)
    {
        $part = preg_replace("/[\n]/", '', $part);
        $part = preg_replace("/ {2,}/", ' ', $part);
        $part = trim(ltrim($part, $annotation));
        $part[0] = '[';
        $part[strlen($part) - 1] = ']';
        $part = eval("return($part);");

        return $part;
    }
}