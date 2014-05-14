<?php
namespace GSoares\EasyJsonDoc\Factory;

use GSoares\EasyJsonDoc\Map\Resource;
use GSoares\EasyJsonDoc\Exception\InvalidConfigurationException;


class ResourceMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\EasyJsonDoc\Map\Resource
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
        $resource->setMethod($data['method']);

        return $resource;
    }
}