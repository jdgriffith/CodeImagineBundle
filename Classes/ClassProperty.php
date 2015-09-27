<?php

namespace Classes;

use Classes\Generators\GeneratorInterface;

/**
 * Class ClassProperty.
 */
class ClassProperty extends Property implements GeneratorInterface
{
    /**
     * @var string
     */
    private $visibility = 'private';

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    public function generate()
    {
        return <<<PROPERTY
	/**
     * @var {$this->getType()}
     */
    {$this->getVisibility()} \${$this->getName()};
PROPERTY;
    }
}
