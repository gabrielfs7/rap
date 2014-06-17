<?php

namespace GSoares\RAP\Request;

use GSoares\RAP\Map\MapInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface RequestValidatorInterface
 *
 * @package GSoares\RAP\Request
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
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