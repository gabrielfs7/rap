<?php
namespace GSoares\RAP\Serializer;

use GSoares\RAP\Property\PropertyRetriever;
use GSoares\RAP\Property\PropertyValueSelector;
use GSoares\RAP\Map\Property;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Map\AbstractParam;

class JsonSerializer
{

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
        PropertyValueSelector $propertyValueSelector = null,
        AnnotationParser $annotationParser = null
    ) {
        $this->propertyValueSelector = $propertyValueSelector ?: new PropertyValueSelector();
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
    }

    /**
     * @param AbstractParam $param
     * @return \stdClass>|\stdClass[]
     */
    public function serialize(AbstractParam $param)
    {
        $obj = new \stdClass();
        $name = $param->getName();

        if ($param->isPrimitive()) {
            if ($name) {
                $obj->$name = $this->getDefaultValue($param);
            } else {
               $obj = $this->getDefaultValue($param);
            }
        }

        if ($param->isClass()) {
            $class = str_replace('[]', '', $param->getType());

            foreach ((new \ReflectionClass($class))->getProperties(\ReflectionProperty::IS_PUBLIC) as $prop) {
                $property = $this->getProperty($prop);

                if ($property) {
                    $this->fillProperty($property, $obj);
                }
            }
        }

        return $obj;
    }

    /**
     * @param AbstractParam $property
     * @param \stdClass $dto
     * @return mixed
     */
    private function fillProperty(AbstractParam $property, \stdClass $dto)
    {
        $name = $property->getName();

        if ($property->isArray()) {
            if ($property->isClass()) {
                return $dto->$name = [$this->serialize($property)];
            }

            return $dto->$name = [$this->getDefaultValue($property)];
        }

        if ($property->isClass()) {
            return $dto->$name = $this->serialize($property);
        }

        if ($property->isPrimitive()) {
            return $dto->$name = $this->getDefaultValue($property);
        }
    }

    /**
     * @param \ReflectionProperty $property
     * @return \GSoares\RAP\Map\Property
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
     * @param AbstractParam $property
     * @return string|number|boolean
     */
    private function getDefaultValue(AbstractParam $property)
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
