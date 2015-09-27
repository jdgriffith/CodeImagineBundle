<?php

namespace Classes;

use Classes\Generators\GeneratorInterface;

/**
 * Class MethodParameter.
 */
class MethodParameter extends Property implements GeneratorInterface
{
    /**
     * @return string
     */
    public function generate()
    {
        $param = '';

        // if typehinting should be done
        if (!$this->isPrimitive()) {
            $param = $this->type.' ';
        }

        return $param.'$'.$this->name;
    }

    /**
     * @return bool
     */
    public function isPrimitive()
    {

        // Determine if primitive
        if (in_array($this->type, ['string', 'int', 'float', 'bool', 'mixed'])) {
            return true;
        }

        return false;
    }
}
