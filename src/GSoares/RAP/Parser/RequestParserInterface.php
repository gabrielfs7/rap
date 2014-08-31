<?php
namespace GSoares\RAP\Parser;

use Symfony\Component\HttpFoundation\Request;

/**
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface RequestParserInterface
{

    /**
     * @param string $method
     * @param Request $request
     * @return mixed
     */
    public function parse($method, Request $request);
}