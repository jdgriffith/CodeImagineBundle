<?php

namespace Command;

use Classes\Translators\YamlToClassTranslator;
use Classes\Writers\ClassWriter;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class GenerateClassCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('generate:class')
            ->setDescription('Generate Class')
            ->addOption(
                'file',
                '',
                InputOption::VALUE_OPTIONAL,
                'What file would you like to parse?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getOption('file');
        $pwd = trim(`pwd`);

        if ($file) {
            $yaml = Yaml::parse(file_get_contents($pwd.'/'.$file));

            $classTranslator = new YamlToClassTranslator($yaml);

            $classes = $classTranslator->getClasses();

            foreach ($classes as $key => $class) {
                $classWriter = new ClassWriter($class, new FileSystem(), $pwd.'/GeneratedClasses/');
                $classWriter->write();
            }
        }

        $output->writeln('Files Written');
    }
}
