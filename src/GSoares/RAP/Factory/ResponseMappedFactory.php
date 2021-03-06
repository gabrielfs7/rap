<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Map\Response;
use GSoares\RAP\Exception\InvalidConfigurationException;
use GSoares\RAP\Map\Param;

/**
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ResponseMappedFactory
{

    /**
     * @param array $data
     * @return Response
     * @throws \GSoares\RAP\Exception\InvalidConfigurationException
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


        if (!empty($response->getReturn())) {
            $param = new Param();
            $param->setType($response->getReturn());

            $response->addParam($param);
        }

        return $response;
    }
}