<?php
namespace GSoares\RAP\Property;

use GSoares\RAP\Exception\InvalidTypeException;
use GSoares\RAP\Annotation\AnnotationRetriever;
use GSoares\RAP\Annotation\Annotation;

class PropertyRetriever
{

    /**
     * @var AnnotationRetriever
     */
    private $annotationRetriever;

    /**
     * @var PropertyFactory
     */
    private $propertyFactory;

    /**
     * @param AnnotationRetriever $annotationRetriever
     * @param PropertyFactory $propertyFactory
     */
    public function __construct(AnnotationRetriever $annotationRetriever = null, PropertyFactory $propertyFactory = null)
    {
        $this->annotationRetriever = $annotationRetriever ?: new AnnotationRetriever();
        $this->propertyFactory = $propertyFactory ?: new PropertyFactory();
    }

    /**
     * @param string $className
     * @param string $propertyName
     * @return Property
     * @throws \InvalidArgumentException
     */
    public function retrieve($className, $propertyName)
    {
        $type = null;
        $sample = null;

        $annotations = $this->annotationRetriever->retrieve($this->getComment($className, $propertyName));

        foreach ($annotations as $annotation) {
            if ($annotation->name == Annotation::ANNOTATION_VAR) {
                $type = $annotation->value;
            }

            if ($annotation->name == Annotation::ANNOTATION_SAMPLE) {
                $sample = $annotation->value;
            }

            if ($type && $sample) {
                break;
            }
        }

        $propertyDto = $this->propertyFactory->create($propertyName, $type, $sample);


        if (!$type) {
            throw new InvalidTypeException(
                'Property ' . $propertyName . ' of class ' . $className .
                 ' has no type. Please use the @var annotation at property PHPDoc'
            );
        }

        return $propertyDto;
    }

    /**
     * @param string $className
     * @param string $propertyName
     * @return string[]
     */
    private function getComment($className, $propertyName)
    {
        return (new \ReflectionClass($className))->getProperty($propertyName)->getDocComment();
    }
}