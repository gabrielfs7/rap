<?php
namespace GSoares\RAP\Parser;

/**
 * @package GSoares\RAP\Parser
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface AnnotationInterface
{
    const RESOURCE = 'RAP/Resource';
    const PARAM = 'RAP/Param';
    const PROPERTY = 'RAP/Property';
    const RESPONSE = 'RAP/Response';
}