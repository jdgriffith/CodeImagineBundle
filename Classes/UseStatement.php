<?php

namespace Classes;

use Classes\Generators\GeneratorInterface;

/**
 * Class UseStatement.
 */
class UseStatement implements GeneratorInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return <<<USE
use {$this->getClass()};
USE;
    }
}
