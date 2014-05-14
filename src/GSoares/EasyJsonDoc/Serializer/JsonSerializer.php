<?php
namespace GSoares\EasyJsonDoc\Serializer;

use GSoares\EasyJsonDoc\Property\PropertyRetriever;
use GSoares\EasyJsonDoc\Property\PropertyValueSelector;
use GSoares\EasyJsonDoc\Map\Property;
use GSoares\EasyJsonDoc\Parser\AnnotationParser;
use GSoares\EasyJsonDoc\Map\AbstractParam;

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
     * @var AnnotationParser
     */
    private $annotationParser;

    /**
     * @param PropertyRetriever $propertyRetriever
     */
    public function __construct(
        PropertyRetriever $propertyRetriever = null,
        PropertyValueSelector $propertyValueSelector = null,
        AnnotationParser $annotationParser = null
    ) {
        $this->propertyRetriever = $propertyRetriever ?: new PropertyRetriever();
        $this->propertyValueSelector = $propertyValueSelector ?: new PropertyValueSelector();
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
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
            $property = $this->getProperty($prop);

            if ($property) {
                $this->fillProperty($property, $dto);
            }
        }

        return $dto;
    }

    /**
     * @param \ReflectionProperty $property
     * @return \GSoares\EasyJsonDoc\Map\Property
     */
    private function getProperty(\ReflectionProperty $property)
    {
        foreach ($this->annotationParser->parse($property->getDocComment()) as $prop) {
            if ($prop instanceof Property) {
                return $prop;
            }
        }
    }

    /**
     * @param Property $property
     * @param \stdClass $dto
     * @return mixed
     */
    private function fillProperty(Property $property, \stdClass $dto)
    {
        $name = $property->getName();

        if ($property->isArray()) {
            if ($property->isClass()) {
                return $dto->$name = [$this->internalSerialize(str_replace('[]', '', $property->getType()))];
            }

            return $dto->$name = $this->getDefaultValue($property);
        }

        if ($property->isClass()) {
            return $dto->$name = $this->internalSerialize($property->getType());
        }

        if ($property->isPrimitive()) {
            return $dto->$name = $this->getDefaultValue($property);
        }
    }

    /**
     * @param Property $property
     * @return string|number|boolean
     */
    private function getDefaultValue(Property $property)
    {
        if ($property->getSample()) {
            return $property->getSample();
        }

        if ($property->getType() === AbstractParam::DATE) {
            return date('Y-m-d');
        }

        if ($property->getType() === AbstractParam::DATETIME) {
            return date('Y-m-d H:i:s');
        }

        if ($property->getType() === AbstractParam::INTEGER) {
            return 123;
        }

        if ($property->getType() === AbstractParam::FLOAT) {
            return 12.3;
        }

        if ($property->getType() === AbstractParam::BOOLEAN) {
            return true;
        }

        if ($property->getType() === AbstractParam::STRING) {
            return 'Lorem Ipsum';
        }
    }
}