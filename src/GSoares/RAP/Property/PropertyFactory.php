<?php
namespace GSoares\RAP\Property;

use GSoares\RAP\Map\AbstractParam;
class PropertyFactory
{

    /**
     * @param string $name
     * @param string $type
     * @param string $sample
     * @return \GSoares\RAP\Property\Property
     */
    public function create($name, $type, $sample = null)
    {
        $property = new Property();
        $property->name = $name;
        $property->type = str_replace('[]', '', $type);
        $property->sample = $sample;

        if (strstr($type, '[]') !== false) {
            $property->isArray = true;
        }

        if (in_array(strtolower($type), $this->getAllowedTypes())) {
            $property->isPrimitive = true;
        }

        if ($property->type !== AbstractParam::DATETIME && class_exists($property->type)) {
            $property->isClass = true;
        }

        return $property;
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