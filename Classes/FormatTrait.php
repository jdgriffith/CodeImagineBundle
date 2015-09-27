<?php

namespace Classes;

/**
 * Class FormatTrait.
 */
trait FormatTrait
{
    /**
     * Number of spaces to use for indention in generated code.
     */
    protected $numSpaces = 4;

    /**
     * @var string
     */
    public $spaces = '    ';

    /**
     * @var string
     */
    public $tab = '    ';

    /**
     * @param $text
     *
     * @return int
     */
    public static function countLines($text)
    {
        return count(preg_split('/\n|\r/', $text));
    }

    /**
     * @return string
     */
    public function getSpaces()
    {
        return $this->spaces;
    }

    /**
     * @param string $spaces
     */
    public function setSpaces($spaces)
    {
        $this->spaces = $spaces;
    }
}
