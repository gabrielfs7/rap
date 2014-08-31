<?php
namespace GSoares\RAP\Document;

use GSoares\RAP\Parser\AnnotationInterface;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationParserInterface;
use GSoares\RAP\Serializer\JsonSerializer;
use GSoares\RAP\Map\Resource;
use GSoares\RAP\Map\Param;
use GSoares\RAP\Map\Response;
use GSoares\RAP\Serializer\JsonFormatter;
use GSoares\RAP\Map\ResourceDocument;

/**
 * @package GSoares\RAP\Document
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class DocumentFactory
{

    /**
     * @var \GSoares\RAP\Parser\AnnotationParserInterface
     */
    private $parser;

    /**
     * @var \GSoares\RAP\Serializer\JsonSerializer
     */
    private $serializer;

    /**
     * @param AnnotationParserInterface $parser
     * @param JsonSerializer $serializer
     */
    public function __construct(AnnotationParserInterface $parser = null, JsonSerializer $serializer = null)
    {
        $this->parser = $parser ?: new AnnotationParser();
        $this->serializer = $this->serializer ?: new JsonSerializer();
    }

    /**
     * @param array $classes
     * @return multitype:\stdClass
     */
    public function create(array $classes)
    {
        $out = [];

        foreach ($classes as $class => $presentation) {
            $dto = new ResourceDocument();
            $dto->setClassName($class);
            $dto->setSlug(preg_replace('/[^[a-zA-Z\-0-9]]/', '', $presentation));
            $dto->setPresentation($presentation);

            foreach ($this->getMethods($class) as $method) {
                $resource = null;
                $params = [];
                $responses = [];

                foreach ($this->parser->parse($method->getDocComment()) as $var) {
                    if ($var instanceof Resource) {
                        $resource = $var;
                    }

                    if ($var instanceof Param) {
                        $params[] = $var;
                    }

                    if ($var instanceof Response) {
                        $var->setSample($this->createResponse($var));

                        $responses[] = $var;
                    }
                }

                $resource->setParams($params);
                $resource->setResponses($responses);
                $resource->setSample($this->createRequestSample($resource));

                $dto->addResource($resource);
            }

            $out[] = $dto;
        }

        return $out;
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function createResponse(Response $response)
    {
        return JsonFormatter::format(json_encode($this->serializer->serialize(current($response->getParams()))));
    }

    /**
     * @param Resource $resource
     * @return string
     */
    private function createRequestSample(Resource $resource)
    {
        $sample = [];

        foreach ($resource->getParams() as $param) {
            $paramValue = null;

            if ($param->isPrimitive()) {
                $paramValue = $this->serializer->serialize($param);
            }

            if ($param->isClass()) {
                $paramValue = (object) [$param->getName() => $this->serializer->serialize($param)];
            }

            $sample = array_merge($sample, (array) $paramValue);
        }

        return $this->createHeader($resource, $sample);
    }

    /**
     * @param Resource $resource
     * @param array $sample
     * @return string
     */
    private function createHeader(Resource $resource, array $sample)
    {
        $q = $resource->getMethod() == 'GET' && count($sample) ? http_build_query($sample) : null;

        $out = $resource->getMethod() . ' ' . $resource->getUri() . ($q ? ('?' . $q) : null ) . ' HTTP/1.1';
        $out.= PHP_EOL . 'Host: ' . Documentor::getHost();
        $out.= PHP_EOL . 'Accept: application/json';
        $out.= PHP_EOL . 'Content-Type: application/json';

        if (count($sample) && $resource->getMethod() !== 'GET') {
            $out .= PHP_EOL . JsonFormatter::format(json_encode($sample));
        }

        return $out;
    }

    /**
     * @return \ReflectionMethod[]
     */
    private function getMethods($class)
    {
        $out = [];

        foreach ((new \ReflectionClass($class))->getMethods() as $method) {
            if (strstr($method->getDocComment(), AnnotationInterface::RESOURCE)) {
                $out[] = $method;
            }
        }

        return $out;
    }
}