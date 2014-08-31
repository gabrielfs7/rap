<?php
namespace GSoares\RAP\Map;

use GSoares\RAP\Exception\InvalidTypeException;

/**
 * @package GSoares\RAP\Map
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
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
     * @var boolean
     */
    private $isArray;

    /**
     * @var boolean
     */
    private $isClass;

    /**
     * @var boolean
     */
    private $isPrimitive;

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
     * @param $type
     * @throws \GSoares\RAP\Exception\InvalidTypeException
     */
    public function setType($type)
    {
        $this->isArray = strpos($type, '[]') !== false;

        $type = str_replace('[]', '', $type);

        $this->isPrimitive = in_array(
            $type,
            [self::STRING, self::INTEGER, self::DATE, self::DATETIME, self::BOOLEAN, self::FLOAT]
        );

        $this->isClass = $type !== self::DATETIME && class_exists($type);

        if (!$this->isClass() && !$this->isPrimitive()) {
            throw new InvalidTypeException('Type "' . $type . '" not found');
        }

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
    public function isRequired()
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
        return $this->isArray;
    }

    /**
     * @return boolean
     */
    public function isPrimitive()
    {
        return $this->isPrimitive;
    }

    /**
     * @return boolean
     */
    public function isClass()
    {
        return $this->isClass;
    }
}