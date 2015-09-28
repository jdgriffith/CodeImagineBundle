<?php

namespace Tests\Classes\Generators;

use Classes\ClassMethod;

/**
 * Class ClassMethodTest.
 *
 * @coversDefaultClass \Classes\ClassMethod
 */
class ClassMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassMethod
     */
    private $classMethod;

    public function setup()
    {
        $this->classMethod = new ClassMethod('test');
    }

    /**
     * @covers ::generate
     */
    public function testGenerate()
    {
        $classMethod = $this->classMethod->generate();

        $this->assertRegExp('/public function test\(\) \{/', $classMethod);
        $this->assertRegExp('/\}/', $classMethod);
    }

    /**
     * @covers ::convertReflectionMethod
     */
    public function testConvertReflectionMethod()
    {
        $reflectionClass = new \ReflectionClass($this);
        $method = $reflectionClass->getMethod('dummyMethod');

        /** @var ClassMethod $classMethod */
        $this->classMethod->convertReflectionMethod($method);

        $methodParams = $this->classMethod->getParameters();

        $this->assertInstanceOf('\Classes\MethodParameter', $methodParams[0]);
    }

    /**
     * Used only for testConvertReflectionMethod.
     *
     * @param string $testing
     * @param string $doubleTesting
     */
    private function dummyMethod($testing, $doubleTesting)
    {
    }
}
