<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Response;
use GSoares\RAP\Exception\InvalidConfigurationException;


class ResponseMappedFactory
{

    /**
     * @param array $data
     * @return \GSoares\RAP\Map\Response
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