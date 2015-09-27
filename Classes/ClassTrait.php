<?php

namespace Classes;

use Classes\Generators\GeneratorInterface;

/**
 * Class ClassTrait.
 */
class ClassTrait extends UseStatement implements GeneratorInterface
{
    /**
     * @return string
     */
    public function generate()
    {
        $useStatement = parent::generate();

        return <<<TRAIT
	{$useStatement}
TRAIT;
    }
}
