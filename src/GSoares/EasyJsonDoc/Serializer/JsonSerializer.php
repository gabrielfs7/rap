<?php
namespace GSoares\EasyJsonDoc\Serializer;

use GSoares\EasyJsonDoc\Property\PropertyRetriever;
use GSoares\EasyJsonDoc\Property\Property;

class JsonSerializer
{
    /**
     * @var PropertyRetriever
     */
    private $propertyRetriever;

    /**
     * @param PropertyRetriever $propertyRetriever
     */
    public function __construct(PropertyRetriever $propertyRetriever = null)
    {
        $this->propertyRetriever = $propertyRetriever ?: new PropertyRetriever();
    }

    public function serialize($class)
    {
        return json_encode($this->internalSerialize($class));
    }

    /**
     * @param string $class
     * @return \stdClass
     */
    private function internalSerialize($class)
    {
        $dto = new \stdClass();

        foreach ((new \ReflectionClass($class))->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
            $property = $this->propertyRetriever->retrieve($class, $prop->getName());
            $name = $prop->getName();

            if ($property->isArray) {
                $dto->$name = [$this->internalSerialize($property->type)];

                continue;
            }

            if ($property->isPrimitive) {
                $dto->$name = $this->fill($property->type, $property->sample);

                continue;
            }

            if ($property->isClass) {
                $dto->$name = $this->internalSerialize($property->type);

                continue;
            }
        }

        return $dto;
    }

    /**
     * @param string $value
     * @param string $sample
     * @return string|number|boolean
     */
    private function fill($value, $sample = null)
    {
        if ($sample) {
            return $sample;
        }

        if ($value === Property::DATE) {
            return date('Y-m-d');
        }

        if ($value === Property::DATETIME) {
            return date('Y-m-d H:i:s');
        }

        if ($value === Property::INT || $value === Property::INTEGER) {
            return 123;
        }

        if ($value === Property::FLOAT || $value === Property::DECIMAL) {
            return 12.3;
        }

        if ($value === Property::BOOLEAN || $value === Property::BOOL) {
            return true;
        }

        if ($value === Property::STRING) {
            return 'Lorem Ipsum';
        }
    }
}