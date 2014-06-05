<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Param;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ParamMappedFactory extends AbstractParamMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\RAP\Map\Param
     */
    public function create(array $data)
    {
        return parent::createByParam($data, new Param());
    }
}