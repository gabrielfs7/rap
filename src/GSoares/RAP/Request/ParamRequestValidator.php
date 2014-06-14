<?php

namespace GSoares\RAP\Request;

use GSoares\RAP\Exception\RequiredParameterMissingException;
use GSoares\RAP\Factory\ParamMappedRequestFactory;
use GSoares\RAP\Map\MapInterface;
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
     * @param ParamMappedRequestFactory $paramMappedRequestFactory
     */
    public function __construct(ParamMappedRequestFactory $paramMappedRequestFactory = null)
    {
        $this->paramMappedRequestFactory = $paramMappedRequestFactory ?: new ParamMappedRequestFactory();
    }

    /**
     * @param MapInterface $map
     * @param Request $request
     * @return MapInterface|mixed
     * @throws \GSoares\RAP\Exception\RequiredParameterMissingException
     */
    public function validate(MapInterface $map, Request $request)
    {
        if (empty($request->get($map->getName())) && $map->isRequired()) {
            throw new RequiredParameterMissingException($map->getName());
        }

        return $this->paramMappedRequestFactory->create($request, $map);
    }
} 