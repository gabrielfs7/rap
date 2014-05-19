<?php
namespace GSoares\RAP\Map;

abstract class AbstractParam implements MapInterface
{
    const STRING = 'string';
    const INTEGER = 'integer';
    const FLOAT = 'float';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const BOOLEAN = 'boolean';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $sample;

    /**
     * @var string
     */
    private $help;

    /**
     * @var boolean
     */
    private $required;

    /**
     * @var string
     */
    private $default;

	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

	/**
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

	/**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

	/**
     * @return the $sample
     */
    public function getSample()
    {
        return $this->sample;
    }

	/**
     * @param string $sample
     */
    public function setSample($sample)
    {
        $this->sample = $sample;
    }

	/**
     * @return the $help
     */
    public function getHelp()
    {
        return $this->help;
    }

	/**
     * @param string $help
     */
    public function setHelp($help)
    {
        $this->help = $help;
    }

	/**
     * @return the $required
     */
    public function getRequired()
    {
        return $this->required;
    }

	/**
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

	/**
     * @return the $default
     */
    public function getDefault()
    {
        return $this->default;
    }

	/**
     * @param string $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @return boolean
     */
    public function isArray()
    {
        return strpos($this->type, '[]') !== false;
    }

    /**
     * @return boolean
     */
    public function isPrimitive()
    {
        return in_array(
            str_replace('[]', '', $this->type),
            [self::STRING, self::INTEGER, self::DATE, self::DATETIME, self::BOOLEAN, self::FLOAT]
        );
    }

    /**
     * @return boolean
     */
    public function isClass()
    {
        return class_exists(str_replace('[]', '', $this->type));
    }
}