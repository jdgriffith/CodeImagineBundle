<?php

namespace Classes\Writers;

use Classes\BaseClass;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class ClassWriter.
 */
class ClassWriter implements WriterInterface
{
    /**
     * @var BaseClass
     */
    private $baseClass;

    /**
     * @var FileSystem
     */
    private $fileSystem;

    /**
     * @var \SplFileInfo
     */
    private $path;

    /**
     * @param BaseClass          $baseClass
     * @param Filesystem         $fileSystem
     * @param string|SplFileInfo $path
     */
    public function __construct(BaseClass $baseClass, FileSystem $fileSystem, $path = '')
    {
        $this->baseClass = $baseClass;
        $this->fileSystem = $fileSystem;

        $this->path = new \SplFileInfo(__DIR__);

        if (is_object($path) && is_a($path, 'SplFileInfo')) {
            $this->path = $path;
        } elseif (!empty($path)) {
            $this->path = new \SplFileInfo($path);
        }
    }

    /**
     * Writes the class to a file.
     */
    public function write()
    {
        try {
            $dir = ($this->path->isDir()) ? $this->path->getPathname() : $this->path->getPath();
            $path = $dir.'/'.$this->baseClass->getClassName().$this->baseClass->getExtension();

            if (!file_exists($dir)) {
                $this->fileSystem->mkdir($dir, 0777, true);
            }

            //if (!file_exists($path)) {
                file_put_contents($path, $this->baseClass->generate());
            //}
        } catch (IOExceptionInterface $e) {
        }
    }

    /**
     * @return Filesystem
     */
    public function getFileSystem()
    {
        return $this->fileSystem;
    }

    /**
     * @return \SplFileInfo
     */
    public function getPath()
    {
        return $this->path;
    }
}
