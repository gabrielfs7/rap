<?php
namespace GSoares\EasyJsonDoc\Property;

use GSoares\EasyJsonDoc\Parser\CommentLineParser;
use GSoares\EasyJsonDoc\Exception\TypeNotFoundException;

class PropertyRetriever
{

    /**
     * @var CommentLineParser
     */
    private $lineParser;

    /**
     * @var PropertyFactory
     */
    private $propertyFactory;

    /**
     * @param CommentLineParser $lineParser
     * @param PropertyFactory $propertyFactory
     */
    public function __construct(CommentLineParser $lineParser = null, PropertyFactory $propertyFactory = null)
    {
        $this->lineParser = $lineParser ?: new CommentLineParser();
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

        foreach ($this->getComment($className, $propertyName) as $commentLine) {
            $found = $this->lineParser->findType($commentLine);

            if ($found) {
                $type = $found;
            }

            $found = $this->lineParser->findSample($commentLine);

            if ($found) {
                $sample = $found;
            }

            if ($type && $sample) {
                break;
            }
        }

        $propertyDto = $this->propertyFactory->create($propertyName, $type, $sample);

        if (!$type) {
            throw new TypeNotFoundException(
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
        return explode(PHP_EOL, (new \ReflectionClass($className))->getProperty($propertyName)->getDocComment());
    }
}