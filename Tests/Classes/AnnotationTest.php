<?php

namespace Tests\Classes\Generators;

use Classes\Annotation;

/**
 * Class AnnotationTest.
 *
 * @coversDefaultClass \Classes\Annotation
 */
class AnnotationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Annotation
     */
    private $annotation;

    public function setup()
    {
        $this->annotation = new Annotation('regard', 'string');
    }

    public function testAnnotationGenerator()
    {
        $annotation = $this->annotation->generate();

        $this->assertEquals(trim($annotation), '* @regard', 'Annotation generated.');
    }
}
