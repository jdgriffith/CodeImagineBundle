<?php

namespace Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShippableTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('shippable:run')
            ->setDescription('Run tests using shippable phpunit command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        shell_exec('mkdir -p shippable/codecoverage');
        shell_exec('mkdir -p shippable/html');
        shell_exec('mkdir -p shippable/testresults');

        $result = shell_exec('phpunit --log-junit shippable/testresults/junit.xml --coverage-xml shippable/codecoverage --coverage-html shippable/html -c app');

        $output->write($result);
        $output->writeln('Tests completed');
    }
}
