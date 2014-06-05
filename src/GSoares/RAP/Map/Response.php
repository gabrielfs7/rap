<?php
namespace GSoares\RAP\Map;

use GSoares\RAP\Exception\InvalidStatusCodeException;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Response implements MapInterface
{
    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $return;

    /**
     * @var string
     */
    private $help;

    /**
     * @var Param[]
     */
    private $params = [];

    /**
     * @var mixed
     */
    private $sample;

	/**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

	/**
     * @param string $status
     */
    public function setStatus($status)
    {
        if (!in_array($status, array_keys(HttpResponseStatus::$statusTexts))) {
            throw new InvalidStatusCodeException($status);
        }

        $this->status = $status;
    }

	/**
     * @return the $return
     */
    public function getReturn()
    {
        return $this->return;
    }

	/**
     * @param string $return
     */
    public function setReturn($return)
    {
        $this->return = $return;
    }

	/**
     * @return the $help
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
     * @return Param[]
     */
    public function getParams()
    {
        return $this->params;
    }

	/**
     * @param Param $param
     */
    public function addParam(Param $param)
    {
        $this->params[] = $param;
    }

	/**
     * @return mixed $sample
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
