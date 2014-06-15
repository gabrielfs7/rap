<?php
namespace GSoares\RAP\Factory;

use GSoares\RAP\Exception\InvalidConfigurationException;
use GSoares\RAP\Exception\RequiredParameterMissingException;
use GSoares\RAP\Map\AbstractParam;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ParamMappedRequestFactory
 *
 * @package GSoares\RAP\Factory
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ParamMappedRequestFactory
{

    /**
     * @var ParamMappedFactory
     */
    private $paramMappedFactory;

    /**
     * @var RequestClassFactory
     */
    private $requestClassFactory;

    /**
     * @var RequestPrimitiveValueFactory
     */
    private $requestPrimitiveValueFactory;

    public function __construct(
        ParamMappedFactory $paramMappedFactory = null,
        RequestClassFactory $requestClassFactory = null,
        RequestPrimitiveValueFactory $requestPrimitiveValueFactory = null
    ) {
        $this->paramMappedFactory = $paramMappedFactory ?: new ParamMappedFactory();
        $this->requestClassFactory = $requestClassFactory ?: new RequestClassFactory();
        $this->requestPrimitiveValueFactory = $requestPrimitiveValueFactory ?: new RequestPrimitiveValueFactory();
    }

    public function create(array $request, AbstractParam $param)
    {
        $paramValue = $request[$param->getName()];

        if ($param->isPrimitive()) {
            return $this->requestPrimitiveValueFactory->create($param, $paramValue);
        }

        if (!$param->isArray()) {
            return $this->requestClassFactory->create($param->getType(), $paramValue);
        }

        $out = [];

        foreach ($paramValue as $value) {
            $out[] = $this->requestClassFactory->create($param->getType(), $value);
        }

        return $out;
    }
}