<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Exception\InvalidConfigurationException;
use GSoares\RAP\Map\AbstractParam;

abstract class AbstractParamMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\RAP\Map\Param
     */
    public function createByParam(array $data, AbstractParam $param)
    {
        $param->setHelp(isset($data['help']) ? $data['help'] : null);
        $param->setRequired(isset($data['required']) ? boolval($data['required']) : true);
        $param->setSample(isset($data['sample']) ? $data['sample'] : null);
        $param->setDefault(isset($data['default']) ? $data['default'] : null);

        if (!isset($data['type'])) {
            throw new InvalidConfigurationException('Configuration "type" required');
        }

        if (!isset($data['name'])) {
            throw new InvalidConfigurationException('Configuration "name" required');
        }

        $param->setType($data['type']);
        $param->setName($data['name']);

        return $param;
    }
}