<?php
namespace GSoares\RAP\Serializer;

use GSoares\RAP\Map\Property;
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Map\AbstractParam;
use GSoares\RAP\Parser\AnnotationParserInterface;

/**
 * Class JsonSerializer
 *
 * @package GSoares\RAP\Serializer
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class JsonSerializer
{
    /**
     * @var AnnotationParserInterface
     */
    private $annotationParser;

    /**
     * @param AnnotationParserInterface $annotationParser
     */
    public function __construct(AnnotationParserInterface $annotationParser = null)
    {
        $this->annotationParser = $annotationParser ?: new AnnotationParser();
    }

    /**
     * @param AbstractParam $param
     * @return \stdClass>|\stdClass[]
     */
    public function serialize(AbstractParam $param)
    {
        $obj = new \stdClass();

        if ($param->isPrimitive()) {
            if ($param->getName()) {
                $obj->{$param->getName()} = $this->getDefaultValue($param);
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

        return $param->isArray() ? [$obj] : $obj;
    }

    /**
     * @param AbstractParam $property
     * @param \stdClass $dto
     * @return mixed
     */
    private function fillProperty(AbstractParam $property, \stdClass $dto)
    {
        if ($property->isClass()) {
            return $dto->{$property->getName()} = $this->serialize($property);
        }

        if ($property->isPrimitive()) {
            return $dto->{$property->getName()} = $this->getDefaultValue($property);
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
