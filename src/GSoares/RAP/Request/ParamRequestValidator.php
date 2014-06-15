<?php

namespace GSoares\RAP\Request;

use GSoares\RAP\Exception\RequiredParameterMissingException;
use GSoares\RAP\Factory\ParamMappedRequestFactory;
use GSoares\RAP\Map\MapInterface;
use GSoares\RAP\Parser\RequestJsonParser;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ParamRequestValidator
 *
 * @package GSoares\RAP\Request
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
     * @return MapInterface|mixed
     * @throws \GSoares\RAP\Exception\RequiredParameterMissingException
     */
    public function validate(MapInterface $map, Request $request)
    {
        $requestData = $this->requestJsonParser->parse($request);

        if (empty($requestData[$map->getName()]) && $map->isRequired()) {
            throw new RequiredParameterMissingException($map->getName());
        }

        return $this->paramMappedRequestFactory->create($requestData, $map);
    }
} 