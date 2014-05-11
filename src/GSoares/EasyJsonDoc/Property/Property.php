<?php
namespace GSoares\EasyJsonDoc\Property;

class Property
{
    const STRING = 'string';
    const INT = 'int';
    const INTEGER = 'integer';
    const DECIMAL = 'decimal';
    const FLOAT = 'float';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const BOOLEAN = 'boolean';
    const BOOL = 'bool';
    const ANNOTATION_SAMPLE = '@EasyJsonDoc\Sample';

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $sample;

    /**
     * @var boolean
     */
    public $isArray;

    /**
     * @var boolean
     */
    public $isPrimitive;

    /**
     * @var boolean
     */
    public $isClass;
}