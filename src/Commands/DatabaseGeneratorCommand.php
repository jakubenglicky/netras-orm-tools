<?php

namespace NextrasOrmTools\Commands;

use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseGeneratorCommand extends Command
{
    public function configure()
    {
        $this
            ->setName('generate:database');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \ReflectionException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $reflector = new ReflectionClass('App\\Model\\Orm\\Test');
        $output->writeln($reflector->getFileName());
    }
}