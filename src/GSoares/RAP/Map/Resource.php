<?php
namespace GSoares\RAP\Map;

/**
 * @package GSoares\RAP\Map
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Resource implements MapInterface
{

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $help;

    /**
     * @var string
     */
    private $method;

    /**
     * @var mixed
     */
    private $sample;

    /**
     * @var Response[]
     */
    private $responses;

    /**
     * @var Param[]
     */
    private $params;

	/**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

	/**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

	/**
     * @return string
     */
    public function getHelp()
    {
        return $this->help;
    }

	/**
     * @param string $help
     */
    public function setHelp($help)
    {
        $this->help = $help;
    }

	/**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

	/**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return Param[]
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return Param[] $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param Param $param
     */
    public function addParam(Param $param)
    {
        $this->params[] = $param;
    }

    /**
     * @return Response[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param Response $response
     */
    public function addResponse(Response $response)
    {
        $this->responses[] = $response;
    }

    /**
     * @param Response[] $responses
     */
    public function setResponses(array $responses)
    {
        $this->responses = $responses;
    }

	/**
     * @return the $sample
     */
    public function getSample()
    {
        return $this->sample;
    }

	/**
     * @param mixed $sample
     */
    public function setSample($sample)
    {
        $this->sample = $sample;
    }

    /**
     * @return boolean
     */
    public function receivesJsonContent()
    {
        foreach ($this->getParams() as $param) {
            if ($param->isArray() | $param->isClass()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getUriParamNames()
    {
        $matches = [];

        $pieces = preg_split('/[\{.\}]+/', $this->getUri());

        foreach ($pieces as $piece) {
            if (strstr($piece, '/') === false && !empty($piece)) {
                $matches[] = $piece;
            }
        }

        return $matches;
    }

    /**
     * @param Param $param
     * @return bool
     */
    public function isUriParam(Param $param)
    {
        return in_array($param->getName(), $this->getUriParamNames());
    }
}