<?php
namespace GSoares\EasyJsonDoc\Serializer;

use GSoares\EasyJsonDoc\Property\PropertyRetriever;
use GSoares\EasyJsonDoc\Property\PropertyValueSelector;
use GSoares\EasyJsonDoc\Property\Property;

class JsonSerializer
{
    /**
     * @var PropertyRetriever
     */
    private $propertyRetriever;

    /**
     * @var PropertyValueSelector
     */
    private $propertyValueSelector;

    /**
     * @param PropertyRetriever $propertyRetriever
     */
    public function __construct(
        PropertyRetriever $propertyRetriever = null,
        PropertyValueSelector $propertyValueSelector = null
    ) {
        $this->propertyRetriever = $propertyRetriever ?: new PropertyRetriever();
        $this->propertyValueSelector = $propertyValueSelector ?: new PropertyValueSelector();
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
            $this->fillProperty($this->propertyRetriever->retrieve($class, $prop->getName()), $dto);
        }

        return $dto;
    }

    /**
     * @param Property $property
     * @param \stdClass $dto
     * @return mixed
     */
    private function fillProperty(Property $property, \stdClass $dto)
    {
        $name = $property->name;

        if ($property->isArray) {
            return $dto->$name = [$this->internalSerialize($property->type)];
        }

        if ($property->isPrimitive) {
            return $dto->$name = $this->propertyValueSelector->select($property);
        }

        if ($property->isClass) {
            return $dto->$name = $this->internalSerialize($property->type);
        }
    }
}