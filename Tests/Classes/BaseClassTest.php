<?php

namespace Tests\Classes\Generators;

use Classes\BaseClass;

/**
 * Class BaseClassTest.
 *
 * @coversDefaultClass \Classes\BaseClass
 */
class BaseClassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BaseClass
     */
    private $baseClass;

    /**
     * Setup.
     */
    public function setup()
    {
        $this->baseClass = new BaseClass('App\Classes\\', 'BaseClass');
    }

    /**
     * @covers ::generate
     */
    public function testGenerate()
    {
        $class = $this->baseClass->generate();

        $expectedClass = '<?php

namespace App\Classes\;


/**
 * Class BaseClass
 *
 * @package App\Classes\
 */
class BaseClass {

}
';
        $this->assertEquals($class, $expectedClass);
        $this->assertRegexp('/namespace/', $class);
        $this->assertRegexp('/\* Class BaseClass/', $class);
    }
}
