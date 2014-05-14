<?php
namespace GSoares\EasyJsonDoc\Map;

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
}