<?php
namespace GSoares\RAP\Map;

/**
 * @package GSoares\RAP\Map
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class Param extends AbstractParam
{
    /**
     * @var boolean
     */
    private $isUriParam;

    /**
     * @param boolean $isUriParam
     */
    public function setIsUriParam($isUriParam)
    {
        $this->isUriParam = $isUriParam;
    }

    /**
     * @return boolean
     */
    public function isUriParam()
    {
        return $this->isUriParam;
    }
}