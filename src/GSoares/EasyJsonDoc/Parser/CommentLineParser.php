<?php
namespace GSoares\EasyJsonDoc\Parser;

use GSoares\EasyJsonDoc\Property\Property;

class CommentLineParser
{

    /**
     * @param string $commentLine
     * @return string
     */
    public function findSample($commentLine)
    {
        if (!$var = strstr($commentLine, Property::ANNOTATION_SAMPLE . ' ')) {
            return;
        }

        return preg_replace('/' . addslashes(Property::ANNOTATION_SAMPLE) . ' /', '', $var);
    }

    /**
     * @param string $commentLine
     * @return string
     */
    public function findType($commentLine)
    {
        if (!$var = strstr($commentLine, '@var ')) {
            return;
        }

        $var = preg_replace('/@var /', '', $var);
        $parts = explode(' ', $var);

        return isset($parts[0]) ? $parts[0] : $var;
    }
}