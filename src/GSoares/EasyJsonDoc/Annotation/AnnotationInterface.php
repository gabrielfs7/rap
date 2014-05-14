<?php
namespace GSoares\EasyJsonDoc\Annotation;

class AnnotationInterface
{
    //const ANNOTATION_RETURN = 'return';
    const ANNOTATION_VAR = '@var';
    //const ANNOTATION_PARAM = '@param';
    const ANNOTATION_SAMPLE = '@EasyJsonDoc/Sample';

    const ANNOTATION_URI = '@EasyJsonDoc\Uri';
    const ANNOTATION_COMMENT = '@EasyJsonDoc\Comment';
    const ANNOTATION_PROPERTY = '@EasyJsonDoc\Property';
    const ANNOTATION_PARAM = '@EasyJsonDoc\Param';
    const ANNOTATION_METHOD = '@EasyJsonDoc\Method';
    const ANNOTATION_RETURN = '@EasyJsonDoc\Return';
}