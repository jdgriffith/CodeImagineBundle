<?php

namespace Classes\Generators;

use Classes\ClassMethod;
use Classes\ClassProperty;
use Classes\MethodParameter;

class ClassPropertyGenerator implements GeneratorInterface
{
    /**
     * @var ClassProperty
     */
    private $classProperty;

    public function __construct(ClassProperty $classProperty)
    {
        $this->classProperty = $classProperty;
    }

    /**
     * @return string
     */
    public function generate()
    {
        $output = '';

        $output .= PHP_EOL.$this->generateGetter()->generate().PHP_EOL;
        $output .= PHP_EOL.$this->generateSetter()->generate().PHP_EOL;

        if ($this->classProperty->getType() == 'array') {
            $output .= PHP_EOL.$this->generateAdd()->generate().PHP_EOL;
        }

        return $output;
    }

    /**
     * @return ClassMethod
     */
    protected function generateGetter()
    {
        $getter = new ClassMethod('get'.ucfirst($this->classProperty->getName()));
        $getter->setDescription('Getter of '.$this->classProperty->getName());
        $getter->setReturn($this->classProperty->getName());
        $getter->setReturnType($this->classProperty->getType());
        $getter->setBody('  return $this->'.$this->classProperty->getName().';');

        return $getter;
    }

    /**
     * @return ClassMethod
     */
    protected function generateSetter()
    {
        $setter = new ClassMethod('set'.ucfirst($this->classProperty->getName()));
        $setter->setDescription('Setter of '.$this->classProperty->getName());
        $setterParam = new MethodParameter($this->classProperty->getName(), $this->classProperty->getType());
        $setter->addParameter($setterParam);

        $body = <<<BODY
	\$this->{$this->classProperty->getName()} = \${$this->classProperty->getName()};
BODY;

        $setter->setBody($body);

        return $setter;
    }

    /**
     * @return ClassMethod
     */
    protected function generateAdd()
    {
        $setter = new ClassMethod('add'.ucfirst($this->classProperty->getName()));
        $setter->setDescription('Add item to '.$this->classProperty->getName());
        $setterParam = new MethodParameter($this->classProperty->getName(), 'mixed');
        $setter->addParameter($setterParam);

        $body = <<<BODY
	\$this->{$this->classProperty->getName()} = \${$this->classProperty->getName()};
BODY;

        $setter->setBody($body);

        return $setter;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
