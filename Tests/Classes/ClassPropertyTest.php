<?php

namespace Tests\Classes\Generators;

use Classes\ClassProperty;

/**
 * Class ClassPropertyTest.
 *
 * @coversDefaultClass \Classes\ClassProperty
 */
class ClassPropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassProperty
     */
    private $classProperty;

    public function setup()
    {
        $this->classProperty = new ClassProperty('testing', 'string');
    }

    /**
     * @covers ::generate
     */
    public function testGenerate()
    {
        $classProperty = $this->classProperty->generate();

        $expectedProperty = '	/**
     * @var string
     */
    private $testing;';

        $this->assertEquals($classProperty, $expectedProperty);
    }
}
