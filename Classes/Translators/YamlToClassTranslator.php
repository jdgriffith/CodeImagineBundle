<?php

namespace Classes\Translators;

use Classes\BaseClass;
use Classes\ClassMethod;
use Classes\ClassProperty;
use Classes\MethodParameter;
use Classes\UseStatement;
use stdClass;

/**
 * Class YamlToClassTranslator.
 */
class YamlToClassTranslator
{
    /**
     * @var array
     */
    private $yaml;

    /**
     * @var array
     */
    private $classes;

    /**
     * @param array $yaml
     */
    public function __construct(array $yaml)
    {
        $this->yaml = $yaml;

        foreach ($this->yaml['classes'] as $key => $class) {
            $this->classes[$key] = $this->translateToBaseClass((object) $class, $key);
        }
    }

    /**
     * @param stdClass $class
     * @param string   $name
     *
     * @return BaseClass
     */
    public function translateToBaseClass(stdClass $class, $name = '')
    {
        $baseClass = new BaseClass($this->yaml['namespace'], $name);

        $baseClass->setProperties($this->translatePropertiesToClassProperty($class->properties));
        $baseClass->setMethods($this->translateMethodsToClassMethod($class->methods));

        if (isset($class->namespace)) {
            $baseClass->setNameSpace($class->namespace);
        }

        if (isset($class->extends)) {
            $baseClass->setExtends($class->extends);
        }

        if (isset($class->implements)) {
            $baseClass->setImplements($class->implements);
        }

        if (isset($class->useStatements)) {
            foreach ($class->useStatements as $key => $useStatement) {
                $baseClass->addUseStatement(new UseStatement($useStatement));
            }
        }

        return $baseClass;
    }

    /**
     * @param array $properties
     *
     * @return array
     */
    private function translatePropertiesToClassProperty(array $properties)
    {
        $result = [];

        foreach ($properties as $key => $property) {
            $result[$key] = new ClassProperty($key, $property['type']);
        }

        return $result;
    }

    /**
     * @param array $methods
     *
     * @return array
     */
    private function translateMethodsToClassMethod(array $methods)
    {
        $result = [];

        foreach ($methods as $key => $method) {
            $method = (object) $method;
            $classMethod = new ClassMethod($key);

            if (isset($method->parameters)) {
                foreach ($method->parameters as $key => $param) {
                    $classMethod->addParameter(new MethodParameter($key, $param['type']));
                }
            }

            $result[] = $classMethod;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }
}
