<?php
namespace GSoares\EasyJsonDoc\Factory;

use GSoares\EasyJsonDoc\Map\Param;

class ParamMappedFactory extends AbstractParamMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\EasyJsonDoc\Map\Param
     */
    public function create(array $data)
    {
        return parent::createByParam($data, new Param());
    }
}