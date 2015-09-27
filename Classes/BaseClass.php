<?php

namespace Classes;

use Classes\Generators\ClassGenerator;
use Classes\Generators\GeneratorInterface;

/**
 * Description of Generator.
 *
 * @author justingriffith
 */
class BaseClass implements GeneratorInterface
{
    use FormatTrait;

    /**
     * @var string
     */
    protected $nameSpace;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var UseStatement[]
     */
    protected $useStatements = [];

    /**
     * @var Annotation[]
     */
    protected $annotations = [];

    /**
     * The extension to use for written php files.
     *
     * @var string
     */
    protected $extension = '.php';

    /**
     * @var string
     */
    protected $classType = 'class';

    /**
     * @var string
     */
    protected $extends = '';

    /**
     * @var array
     */
    protected $implements = [];

    /**
     * @var ClassProperty[]
     */
    protected $properties = [];

    /**
     * @var Method[]
     */
    protected $methods = [];

    /**
     * @param $nameSpace
     * @param $className
     */
    public function __construct($nameSpace, $className)
    {
        $this->nameSpace = $nameSpace;
        $this->className = $className;
    }

    /**
     * @return UseStatement[]
     */
    public function getUseStatements()
    {
        return $this->useStatements;
    }

    /**
     * @param UseStatement $useStatement
     */
    public function addUseStatement(UseStatement $useStatement)
    {
        $this->useStatements[] = $useStatement;
    }

    /**
     * @param UseStatement[] $useStatements
     */
    public function setUseStatements($useStatements)
    {
        $this->useStatements = $useStatements;
    }

    /**
     * @param UseStatement $use
     *
     * @return void
     */
    protected function removeUseStatement(UseStatement $use)
    {
        if (array_search($use, $this->useStatements)) {
            unset($this->useStatements[array_search($use, $this->useStatements)]);
        }
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param $property
     */
    public function addProperty(ClassProperty $property)
    {
        $this->properties[] = $property;
    }

    /**
     * @return string
     */
    public function getNameSpace()
    {
        return $this->nameSpace;
    }

    /**
     * @param string $nameSpace
     */
    public function setNameSpace($nameSpace)
    {
        $this->nameSpace = $nameSpace;
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
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getClassType()
    {
        return $this->classType;
    }

    /**
     * @param string $classType
     */
    public function setClassType($classType)
    {
        $this->classType = $classType;
    }

    /**
     * @return string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * @param string $extends
     */
    public function setExtends($extends)
    {
        $this->extends = $extends;
    }

    /**
     * @return array
     */
    public function getImplements()
    {
        return $this->implements;
    }

    /**
     * @param array $implements
     */
    public function setImplements($implements)
    {
        $this->implements = $implements;
    }

    /**
     * @param $implement
     */
    public function addImplement($implement)
    {
        $this->implements[] = $implement;
    }

    /**
     * @return ClassMethod[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param ClassMethod[] $methods
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
    }

    /**
     * Adds a method to the class.
     *
     * @param ClassMethod $method
     */
    public function addMethod(ClassMethod $method)
    {
        $this->methods[] = $method;
    }

    /**
     * @return array
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * @param array $annotations
     */
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;
    }

    /**
     * @param Annotation $annotation
     */
    public function addAnnotation(Annotation $annotation)
    {
        $this->annotations[] = $annotation;
    }

    /**
     * @return string
     */
    public function generate()
    {
        $generator = new ClassGenerator($this);

        return $generator->generate();
    }

    /**
     * @return bool
     */
    public function hasNameSpace()
    {
        if (!empty($this->nameSpace)) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasExtends()
    {
        if (!empty($this->extends)) {
            return true;
        }

        return false;
    }
}
