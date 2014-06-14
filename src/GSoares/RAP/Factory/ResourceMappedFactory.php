<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Resource;
use GSoares\RAP\Exception\InvalidConfigurationException;

/**
 * Class ResourceMappedFactory
 *
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 * @package GSoares\RAP\Factory
 */
class ResourceMappedFactory
{

    /**
     * @param array $data
     * @return Resource
     * @throws \GSoares\RAP\Exception\InvalidConfigurationException
     */
    public function create(array $data)
    {
        $resource = new Resource();
        $resource->setHelp(isset($data['help']) ? $data['help'] : null);

        if (!isset($data['uri'])) {
            throw new InvalidConfigurationException('Configuration "uri" required');
        }

        if (!isset($data['method'])) {
            throw new InvalidConfigurationException('Configuration "uri" required');
        }

        $resource->setUri($data['uri']);
        $resource->setMethod(strtoupper($data['method']));

        return $resource;
    }
}