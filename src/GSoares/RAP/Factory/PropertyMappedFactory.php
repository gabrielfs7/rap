<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Property;

/**
 * Class PropertyMappedFactory
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class PropertyMappedFactory extends AbstractParamMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\RAP\Map\Param
     */
    public function create(array $data)
    {
        return parent::createByParam($data, new Property());
    }
}