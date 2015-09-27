<?php

namespace Classes;

use Classes\Generators\GeneratorInterface;

/**
 * Class Annotation.
 */
class Annotation implements GeneratorInterface
{
    use FormatTrait;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $type = 'string';

    /**
     * @param $text
     * @param $type
     */
    public function __construct($text, $type)
    {
        $this->text = $text;
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Implement generator method.
     *
     * @return string
     */
    public function generate()
    {
        return <<<ANNOTATION
	* @{$this->getText()}
ANNOTATION;
    }
}
