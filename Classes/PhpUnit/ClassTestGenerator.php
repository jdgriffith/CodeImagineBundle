<?php

namespace Classes\PhpUnit;

use Classes\ClassGenerator;

/**
 * Class ClassTestGenerator.
 */
abstract class ClassTestGenerator extends ClassGenerator
{
    /**
     * @var \SplFileInfo
     */
    protected $fileInfo;

    /**
     * @var ReflectionClass
     */
    protected $reflectionClass;

    /**
     * @param string       $className
     * @param \SplFileInfo $fileInfo
     *
     * @throws \Exception
     */
    public function __construct($className, \SplFileInfo $fileInfo)
    {
        $this->fileInfo = $fileInfo;
        $this->className = $className;

        // if class does not exist
        if (!class_exists($this->classname)) {
            throw new \Exception(sprintf('Class %s does not exist.', $this->classname));
        }

        // Create the reflection class
        $this->reflectionClass = new \ReflectionClass($this->className);
    }

    /**
     * @return string
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
     * @return ReflectionClass
     */
    public function getReflectionClass()
    {
        return $this->reflectionClass;
    }

    /**
     * @param ReflectionClass $reflectionClass
     */
    public function setReflectionClass($reflectionClass)
    {
        $this->reflectionClass = $reflectionClass;
    }

    /**
     * @return SplFileInfo
     */
    public function getFileInfo()
    {
        return $this->fileInfo;
    }

    /**
     * @param SplFileInfo $fileInfo
     */
    public function setFileInfo($fileInfo)
    {
        $this->fileInfo = $fileInfo;
    }

    public function generate()
    {
    }
}
