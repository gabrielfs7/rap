<?php

namespace GSoares\RAP\Request;

use GSoares\RAP\Exception\InvalidRequestMethodException;
use GSoares\RAP\Map\MapInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ResourceRequestValidator
 *
 * @package GSoares\RAP\Request
 */
class ResourceRequestValidator implements RequestValidatorInterface
{

    /**
     * @param MapInterface $map
     * @param Request $request
     * @return MapInterface|void
     * @throws InvalidRequestMethodException
     */
    public function validate(MapInterface $map, Request $request)
    {
        if (!$request->isMethod($map->getMethod())) {
            throw new InvalidRequestMethodException($request->getMethod());
        }
    }
} 