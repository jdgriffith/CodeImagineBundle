<?php

namespace Controller;

use Classes\BaseClass;
use Classes\ClassMethod;
use Classes\ClassProperty;
use Classes\Generators\ClassGenerator;
use Classes\MethodParameter;
use Classes\Writers\ClassWriter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;

class DefaultController extends Controller
{
    /**
     * @Route("/testclass", name="homepage")
     *
     * @Method("GET")
     */
    public function indexAction()
    {
        $class = new BaseClass('Classes', 'BestClass');
        $class->addProperty(new ClassProperty('test', 'string'));

        $method = new ClassMethod('setTest');
        $method->addParameter(new MethodParameter('test', 'string'));
        $method->setReturnType(null);

        $class->addMethod($method);

        $classGenerator = new ClassGenerator($class);
        $classWriter = new ClassWriter($classGenerator, new Filesystem(), '/Users/justingriffith/Sites/CodeCreator/');
        $classWriter->write();

        return $this->render('default/index.html.twig');
    }
}
