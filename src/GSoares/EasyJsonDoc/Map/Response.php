<?php
namespace GSoares\EasyJsonDoc\Map;

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
     * @return the $status
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



}
