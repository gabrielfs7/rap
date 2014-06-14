<?php
namespace GSoares\RAP\Parser;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestParserInterface
 *
 * @package GSoares\RAP\Parser
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