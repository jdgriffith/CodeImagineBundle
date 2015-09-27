<?php

namespace Tests\Classes\Generators;

use Classes\ClassTrait;

/**
 * Class ClassTraitTest.
 *
 * @coversDefaultClass \Classes\ClassTrait
 */
class ClassTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassTrait
     */
    private $classTrait;

    public function setup()
    {
        $this->classTrait = new ClassTrait('Testing', 'Classes\\');
    }

    /**
     * @covers ::generate
     */
    public function testGenerate()
    {
        $classTrait = $this->classTrait->generate();

        $expectedUse = '	use Testing;';

        $this->assertEquals($classTrait, $expectedUse);
    }
}
