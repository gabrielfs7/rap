<?php
namespace GSoares\RAP\Map;

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
}