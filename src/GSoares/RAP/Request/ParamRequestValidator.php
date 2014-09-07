<?php

namespace GSoares\RAP\Request;

use GSoares\RAP\Exception\InvalidParameterException;
use GSoares\RAP\Exception\RequiredParameterMissingException;
use GSoares\RAP\Factory\ParamMappedRequestFactory;
use GSoares\RAP\Map\AbstractParam;
use GSoares\RAP\Map\MapInterface;
use GSoares\RAP\Parser\RequestJsonParser;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package GSoares\RAP\Request
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ParamRequestValidator implements RequestValidatorInterface
{

    /**
     * @var ParamMappedRequestFactory
     */
    private $paramMappedRequestFactory;

    /**
     * @var RequestJsonParser
     */
    private $requestJsonParser;

    /**
     * @param ParamMappedRequestFactory $paramMappedRequestFactory
     * @param RequestJsonParser $requestJsonParser
     */
    public function __construct(
        ParamMappedRequestFactory $paramMappedRequestFactory = null,
        RequestJsonParser $requestJsonParser = null
    ) {
        $this->paramMappedRequestFactory = $paramMappedRequestFactory ?: new ParamMappedRequestFactory();
        $this->requestJsonParser = $requestJsonParser ?: new RequestJsonParser();
    }

    /**
     * @param MapInterface $map
     * @param Request $request
     * @return array|float|MapInterface|int|mixed|string
     * @throws \InvalidArgumentException
     */
    public function validate(MapInterface $map, Request $request)
    {
        if (!$map instanceof AbstractParam) {
            throw new \InvalidArgumentException('Expected AbstractParam, ' . get_class($map) . ' given');
        }

        $requestData = $this->requestJsonParser->parse($request);

        $paramValue = $this->getParamValueByRequest($requestData, $map);

        $this->validateParam($map, $paramValue);

        return $this->paramMappedRequestFactory->create($requestData, $map);
    }

    /**
     * @param array $requestData
     * @param MapInterface $map
     * @return mixed
     */
    private function getParamValueByRequest(array $requestData, MapInterface $map)
    {
        return empty($requestData[$map->getName()]) ? null : $requestData[$map->getName()];
    }

    /**
     * @param MapInterface $map
     * @param $paramValue
     * @throws \GSoares\RAP\Exception\RequiredParameterMissingException
     * @throws \GSoares\RAP\Exception\InvalidParameterException
     */
    private function validateParam(MapInterface $map, $paramValue)
    {
        if ($paramValue === null && $map->isRequired()) {
            throw new RequiredParameterMissingException($map->getName());
        }

        if ($paramValue &&
            $map->isPrimitive() &&
            $map->getPattern() &&
            preg_match('/' . $map->getPattern() . '/', $paramValue) !== 1) {
            throw new InvalidParameterException($map->getName(), $paramValue);
        }
    }
}