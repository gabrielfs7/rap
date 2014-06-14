<?php

namespace GSoares\RAP\Request;


use GSoares\RAP\Map\MapInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestValidatorInterface
 *
 * @package GSoares\RAP\Request
 */
interface RequestValidatorInterface
{
    /**
     * @param MapInterface $map
     * @param Request $request
     * @return MapInterface
     */
    public function validate(MapInterface $map, Request $request);
} 