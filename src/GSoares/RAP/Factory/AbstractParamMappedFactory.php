<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Exception\InvalidConfigurationException;
use GSoares\RAP\Map\AbstractParam;

/**
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
abstract class AbstractParamMappedFactory
{

    /**
     * @param array $data
     * @param AbstractParam $param
     * @return AbstractParam
     * @throws \GSoares\RAP\Exception\InvalidConfigurationException
     */
    public function createByParam(array $data, AbstractParam $param)
    {
        $param->setHelp(isset($data['help']) ? $data['help'] : null);
        $param->setRequired(isset($data['required']) ? boolval($data['required']) : false);
        $param->setSample(isset($data['sample']) ? $data['sample'] : null);
        $param->setDefault(isset($data['default']) ? $data['default'] : null);
        $param->setPattern(isset($data['pattern']) ? $data['pattern'] : null);

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