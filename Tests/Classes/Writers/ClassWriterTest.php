<?php

namespace Tests\Classes\Writers;

use Classes\BaseClass;
use Classes\Writers\ClassWriter;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class ClassWriterTest.
 *
 * @coversDefaultClass \Classes\Writers\ClassWriter
 */
class ClassWriterTest extends \PHPUnit_Framework_TestCase
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
        $this->fileSystem = new Filesystem();
    }

    /**
     * @covers ::__constructor
     */
    public function testConstructorWithNullPath()
    {
        $classWriter = new ClassWriter($this->baseClass, $this->fileSystem);

        /** @var SplFileInfo $path */
        $path = $classWriter->getPath();

        $this->assertInstanceOf('SpLFileInfo', $path);
        $this->assertRegExp('/Writers/', $path->getPathname());
    }

    public function testConstructorWithValidPath()
    {
        $classWriter = new ClassWriter($this->baseClass, $this->fileSystem);

        /** @var SplFileInfo $path */
        $path = $classWriter->getPath();

        $this->assertInstanceOf('SpLFileInfo', $path);
        $this->assertRegExp('/Writers/', $path->getPathname());
    }
}
