<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Resource;
use GSoares\RAP\Exception\InvalidConfigurationException;


class ResourceMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\RAP\Map\Resource
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