<?php
namespace GSoares\RAP\Map;

/**
 * @package GSoares\RAP\Map
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class ResourceDocument implements MapInterface
{

    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $presentation;

    /**
     * @var Resource[]
     */
    private $resources = [];

	/**
     * @return the $className
     */
    public function getClassName()
    {
        return $this->className;
    }

	/**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

	/**
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

	/**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

	/**
     * @return the $presentation
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

	/**
     * @param string $presentation
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
    }

	/**
     * @return Resource[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param \GSoares\RAP\Map\Resource|Resource $resource
     */
    public function addResource(Resource $resource)
    {
        $this->resources[] = $resource;
    }
}