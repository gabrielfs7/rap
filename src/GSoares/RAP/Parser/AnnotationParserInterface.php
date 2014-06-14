<?php
namespace GSoares\RAP\Parser;

/**
 * Interface AnnotationParserInterface
 *
 * @package GSoares\RAP\Parser
 */
interface AnnotationParserInterface
{

    /**
     * @param string $docComment
     * @return \GSoares\RAP\Map\MapInterface[]
     */
    public function parse($docComment);
}