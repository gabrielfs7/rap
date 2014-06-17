<?php
namespace GSoares\RAP\Parser;

/**
 * Interface AnnotationParserInterface
 *
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface AnnotationParserInterface
{

    /**
     * @param string $docComment
     * @return \GSoares\RAP\Map\MapInterface[]
     */
    public function parse($docComment);
}