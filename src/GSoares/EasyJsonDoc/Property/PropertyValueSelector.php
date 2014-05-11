<?php
namespace GSoares\EasyJsonDoc\Property;

class PropertyValueSelector
{

    /**
     * @param string $property->type
     * @param string $sample
     * @return string|number|boolean
     */
    public function select(Property $property)
    {
        if ($property->sample) {
            return $property->sample;
        }

        if ($property->type === Property::DATE) {
            return date('Y-m-d');
        }

        if ($property->type === Property::DATETIME) {
            return date('Y-m-d H:i:s');
        }

        if ($property->type === Property::INT || $property->type === Property::INTEGER) {
            return 123;
        }

        if ($property->type === Property::FLOAT || $property->type === Property::DECIMAL) {
            return 12.3;
        }

        if ($property->type === Property::BOOLEAN || $property->type === Property::BOOL) {
            return true;
        }

        if ($property->type === Property::STRING) {
            return 'Lorem Ipsum';
        }
    }
}