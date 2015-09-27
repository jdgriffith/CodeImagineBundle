<?php

namespace Tests\Classes\Generators;

use Classes\UseStatement;

/**
 * Class UseStatementTest.
 *
 * @coversDefaultClass \Classes\UseStatement
 */
class UseStatementTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UseStatement
     */
    private $useStatement;

    public function setup()
    {
        $this->useStatement = new UseStatement('TheClass');
    }

    /**
     * @covers ::generate
     */
    public function testUseStatementGenerator()
    {
        $useStatement = $this->useStatement->generate();

        $this->assertEquals(trim($useStatement), trim('use TheClass;'), 'Use statement generated.');
    }
}
