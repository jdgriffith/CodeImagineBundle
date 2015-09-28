<?php

namespace Classes\Generators;

use Classes\ClassMethod;
use Classes\FormatTrait;

/**
 * Class ClassMethodGenerator.
 */
class ClassMethodGenerator implements GeneratorInterface
{
    use FormatTrait;

    /**
     * @var ClassMethod
     */
    private $classMethod;

    /**
     * @param $classMethod
     */
    public function __construct($classMethod)
    {
        $this->classMethod = $classMethod;
    }

    /**
     * @return string
     */
    protected function generateDocBlock()
    {
        $docBlock = '/**'.PHP_EOL;

        $docBlock .= $this->generateDescriptionDocBlock();
        $docBlock .= $this->generateAnnotationsDocBlock();
        $docBlock .= $this->generateParametersDocBlock();
        $docBlock .= $this->generateReturnDocBlock();

        $docBlock .= $this->tab.' */';

        // if no content, make it empty
        if ($this->countLines($docBlock) === 2) {
            $docBlock = '';
        }

        return $docBlock;
    }

    /**
     * @return string $docBlock
     */
    private function generateReturnDocBlock()
    {
        $docBlock = '';

        if ($this->classMethod->hasReturn()) {
            $docBlock .= $this->tab.' *'.PHP_EOL;
            $docBlock .= $this->tab.' * @return '.$this->classMethod->getReturnType().' $'.$this->classMethod->getReturn().PHP_EOL;
        }

        return $docBlock;
    }

    /**
     * @return string
     */
    private function generateDescriptionDocBlock()
    {
        if ($this->classMethod->hasDescription()) {
            return $this->tab.' * '.$this->classMethod->getDescription().PHP_EOL;
        }

        return '';
    }

    /**
     * @return string $docBlock
     */
    private function generateParametersDocBlock()
    {
        $docBlock = '';

        if ($this->classMethod->hasParameters()) {
            $docBlock .= $this->tab.' *'.PHP_EOL;

            foreach ($this->classMethod->getParameters() as $parameter) {
                $docBlock .= $this->generateSingleDocBlockLine($parameter, '@param');
            }
        }

        return $docBlock;
    }

    /**
     * @return string $docBlock
     */
    private function generateAnnotationsDocBlock()
    {
        $docBlock = '';

        if ($this->classMethod->hasAnnotations()) {
            $docBlock .= $this->tab.' *'.PHP_EOL;

            foreach ($this->classMethod->getAnnotations() as $annotation) {
                $docBlock .= $this->generateSingleDocBlockLine($annotation);
            }
        }

        return $docBlock;
    }

    /**
     * Generate Single DocBlock line.
     *
     * @param        $generator
     * @param string $prefix
     *
     * @return string
     */
    private function generateSingleDocBlockLine($generator, $prefix = '')
    {
        if (!empty($prefix)) {
            return $this->tab.' * '.$prefix.' '.$generator->generate().PHP_EOL;
        }

        return $this->tab.' * '.$generator->generate().PHP_EOL;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return <<<METHOD
	{$this->generateDocBlock()}
	{$this->classMethod->getVisibility()} function {$this->classMethod->getName()}({$this->generateParameters()}) {
	{$this->classMethod->getBody()}
	}
METHOD;
    }

    /**
     * @return string
     */
    protected function generateParameters()
    {
        $params = [];

        foreach ($this->classMethod->getParameters() as $parameter) {
            $param = (!$parameter->isPrimitive()) ? $parameter->getType().' ' : '';
            $params[] = $param.'$'.$parameter->getName();
        }

        return implode(', ', $params);
    }
}
