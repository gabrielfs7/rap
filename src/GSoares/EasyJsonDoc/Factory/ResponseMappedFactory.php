<?php
namespace GSoares\EasyJsonDoc\Factory;

use GSoares\EasyJsonDoc\Map\Response;
use GSoares\EasyJsonDoc\Exception\InvalidConfigurationException;


class ResponseMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\EasyJsonDoc\Map\Response
     */
    public function create(array $data)
    {
        $response = new Response();
        $response->setHelp(isset($data['help']) ? $data['help'] : null);

        if (!isset($data['status'])) {
            throw new InvalidConfigurationException('Configuration "status" required');
        }

        if (!isset($data['return'])) {
            throw new InvalidConfigurationException('Configuration "return" required');
        }

        $response->setReturn($data['return']);
        $response->setStatus($data['status']);

        return $response;
    }
}