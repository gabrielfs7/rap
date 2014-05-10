<?php
namespace GSoares\EasyJsonDoc\Property;

class PropertyRetriever
{

    public function retrieve($class, $property)
    {
        $dto = new Property();

        $this->getPropertyType((new \ReflectionClass($class))->getProperty($property), $dto);

        return $dto;
    }

    /**
     * @param \ReflectionProperty $property
     * @param Property $prop
     */
    private function getPropertyType(\ReflectionProperty $reflectionProperty, Property $property)
    {
        foreach (explode(PHP_EOL, $reflectionProperty->getDocComment()) as $commentLine) {
            if ($type = $this->findType($commentLine)) {
                $this->configType($property, $type);
            }

            if ($sample = $this->findSample($commentLine)) {
                $property->sample = $sample;
            }
        }

        if (!$property->type) {
            throw new \InvalidArgumentException(
                'The property ' . $reflectionProperty->getName() .
                ' of class ' . $reflectionProperty->getDeclaringClass()->getName() .
                ' has no defined type. Please use the @var annotation at property PHPDoc'
            );
        }
    }

    /**
     * @param string $commentLine
     * @return string
     */
    private function findSample($commentLine)
    {
        if (!$var = strstr($commentLine, Property::ANNOTATION_SAMPLE . ' ')) {
            return;
        }

        return preg_replace('/' . addslashes(Property::ANNOTATION_SAMPLE) . ' /', '', $var);
    }

    /**
     * @param string $commentLine
     * @return string
     */
    private function findType($commentLine)
    {
        if (!$var = strstr($commentLine, '@var ')) {
            return;
        }

        $var = preg_replace('/@var /', '', $var);
        $parts = explode(' ', $var);

        return isset($parts[0]) ? $parts[0] : $var;
    }

    /**
     * @param Property $property
     * @param string $type
     */
    private function configType(Property $property, $type)
    {
        $property->type = str_replace('[]', '', $type);

        if (strstr($type, '[]') !== false) {
            $property->isArray = true;
        }

        if (in_array(strtolower($type), $this->getAllowedTypes())) {
            $property->isPrimitive = true;
        }

        if (class_exists($property->type)) {
            $property->isClass = true;
        }
    }

    /**
     * @return string[]
     */
    private function getAllowedTypes()
    {
        return [
            Property::STRING,
            Property::INT,
            Property::INTEGER,
            Property::DECIMAL,
            Property::FLOAT,
            Property::DATE,
            Property::DATETIME,
            Property::BOOL,
            Property::BOOLEAN
        ];
    }
}