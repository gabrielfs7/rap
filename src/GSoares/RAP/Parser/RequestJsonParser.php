<?php
namespace GSoares\RAP\Parser;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestJsonParser
 *
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class RequestJsonParser
{

    /**
     * @param Request $request
     * @return array
     */
    public function parse(Request $request)
    {
        return (array) json_decode($request->getContent());
    }
}