<?php

namespace Classes;

use Classes\Generators\ClassMethodGenerator;
use Classes\Generators\GeneratorInterface;
use ReflectionMethod;

/**
 * Class ClassMethod.
 */
class ClassMethod implements GeneratorInterface
{
    use FormatTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var MethodParameter[]
     */
    private $parameters = [];

    /**
     * @var string
     */
    private $visibility = 'public';

    /**
     * @var string
     */
    private $return;

    /**
     * @var string
     */
    private $returnType;

    /**
     * @var string
     */
    private $body;

    /**
     * @var Annotation[]
     */
    private $annotations;

    /**
     * Constructor.
     *
     * @param $name
     * @param ReflectionMethod|null $reflectionMethod
     */
    public function __construct($name, ReflectionMethod $reflectionMethod = null)
    {
        $this->name = $name;

        // if reflection method passed
        if ($reflectionMethod != null) {
            $this->convertReflectionMethod($reflectionMethod);
        }
    }

    /**
     * @param $parameter
     */
    public function addParameter(MethodParameter $parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * @return MethodParameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param MethodParameter[] $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param mixed $return
     */
    public function setReturn($return)
    {
        $this->return = $return;
    }

    /**
     * @return mixed
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * @param mixed $returnType
     */
    public function setReturnType($returnType)
    {
        $this->returnType = $returnType;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return Annotation[]
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * @param Annotation[] $annotations
     */
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->generate();
    }

    /**
     * @return string
     */
    public function generate()
    {
        $classMethodGenerator = new ClassMethodGenerator($this);

        return $classMethodGenerator->generate();
    }

    /**
     * @return bool
     */
    public function hasDescription()
    {
        if (!empty($this->description)) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasParameters()
    {
        if (count($this->parameters) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasAnnotations()
    {
        if (count($this->annotations) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasReturn()
    {
        if (!empty($this->return)) {
            return true;
        }

        return false;
    }

    /**
     * @param ReflectionMethod $method
     *
     * @return ClassMethod
     */
    public function convertReflectionMethod(ReflectionMethod $method)
    {
        // just in case not already set
        $this->name = $method->getName();

        foreach ($method->getParameters() as $param) {
            $methodParam = new MethodParameter($param->getName(), 'string');

            $this->addParameter($methodParam);
        }
    }
}
