<?php

namespace Classes\Generators;

use Classes\BaseClass;
use Classes\ClassMethod;
use Classes\UseStatement;

/**
 * Description of Generator.
 *
 * @author justingriffith
 */
class ClassGenerator implements GeneratorInterface
{
    /**
     * @var \Classes\BaseClass
     */
    private $baseClass;

    /**
     * @var string
     */
    protected static $classTemplate =
        '<?php

<nameSpace><useSpace><annotation>
<className> {
<body>
}
';

    /**
     * @var string
     */
    protected static $annotationsTemplate = '
      /**
       <annotation>
       */
      ';

    /**
     * @param BaseClass $baseClass
     */
    public function __construct(BaseClass $baseClass)
    {
        $this->baseClass = $baseClass;
    }

    /**
     * Generate a PHP5 Class.
     *
     * @return string $code
     */
    public function generate()
    {
        $placeHolders = [
            '<nameSpace>',
            '<useSpace>',
            '<annotation>',
            '<className>',
            '<body>',
        ];

        $replacements = [
            $this->generateNameSpace(),
            $this->generateUseStatements(),
            $this->generateAnnotation(),
            $this->generateClassName(),
            $this->generateBody(),
        ];

        $code = str_replace($placeHolders, $replacements, self::$classTemplate);

        return str_replace('<spaces>', $this->baseClass->getSpaces(), $code);
    }

    /**
     * @return string $class
     */
    protected function generateClassName()
    {
        $class = $this->baseClass->getClassType().' '.$this->baseClass->getClassName();

        // If extends
        if ($this->baseClass->hasExtends()) {
            $class .= ' extends '.$this->baseClass->getExtends();
        }

        // Any interfaces
        $class .= $this->generateClassImplements();

        return $class;
    }

    /**
     * @return string
     */
    protected function generateClassImplements()
    {
        $classImplements = '';

        // All implementing classes
        if (count($this->baseClass->getImplements()) > 0) {
            $implements = [];

            foreach ($this->baseClass->getImplements() as $interface) {
                $className = explode('\\', $interface);
                $implements[] = end($className);
            }

            // only the class name without the namespace
            $classImplements .= ' implements '.implode(', ', $implements);
        }

        return $classImplements;
    }

    /**
     * @return string
     */
    protected function generateNameSpace()
    {
        return 'namespace '.$this->baseClass->getNameSpace().';'.PHP_EOL;
    }

    /**
     * @return string $code
     */
    protected function generateBody()
    {
        $body = '';

        foreach ($this->baseClass->getProperties() as $key => $property) {
            $body .= PHP_EOL.$property->generate().PHP_EOL;
        }

        // Getters and Setters immediately after properties
        $body .= $this->generateGettersAndSetters();

        // Interface methods to be implemented
        $body .= $this->generateImplementMethods();

        foreach ($this->baseClass->getMethods() as $method) {
            $body .= PHP_EOL.$method->generate().PHP_EOL;
        }

        return $body;
    }

    /**
     * @return string
     */
    protected function generateAnnotation()
    {
        $annotations = PHP_EOL.'/**'.PHP_EOL;
        $annotations .= ' * Class '.$this->baseClass->getClassName().PHP_EOL;
        $annotations .= ' *'.PHP_EOL;

        if ($this->baseClass->hasNameSpace()) {
            $annotations .= ' * @package '.$this->baseClass->getNameSpace().PHP_EOL;
        }

        foreach ($this->baseClass->getAnnotations() as $annotation) {
            $annotations .= $annotation->generate().PHP_EOL;
        }

        $annotations .= ' */';

        return $annotations;
    }

    /**
     * @return string $useSpace
     */
    protected function generateUseStatements()
    {
        $useStatements = PHP_EOL;

        foreach ($this->baseClass->getUseStatements() as $use) {
            $useStatements .= $use->generate().PHP_EOL;
        }

        foreach ($this->baseClass->getImplements() as $interface) {
            $useStatement = new UseStatement($interface);
            $useStatements .= $useStatement->generate().PHP_EOL;
        }

        return $useStatements;
    }

    /**
     * @return string
     */
    protected function generateGettersAndSetters()
    {
        $output = '';

        foreach ($this->baseClass->getProperties() as $property) {
            $classPropertyGenerator = new ClassPropertyGenerator($property);

            $output .= $classPropertyGenerator->generate();
        }

        return $output;
    }

    protected function generateImplementMethods()
    {
        $output = '';

        foreach ($this->baseClass->getImplements() as $key => $implement) {
            $reflection = new \ReflectionClass($implement);

            foreach ($reflection->getMethods() as $method) {
                $implementor = new ClassMethod($method->name, $method);
                $implementor->setDescription('Implementation of '.$method->getName().' interface method');
                $implementor->setBody(' // TODO: Code implementation');

                $output .= PHP_EOL.$implementor->generate().PHP_EOL;
            }
        }

        return $output;
    }

    /**
     * @return BaseClass
     */
    public function getBaseClass()
    {
        return $this->baseClass;
    }

    /**
     * @param BaseClass $baseClass
     */
    public function setBaseClass(BaseClass $baseClass)
    {
        $this->baseClass = $baseClass;
    }
}
