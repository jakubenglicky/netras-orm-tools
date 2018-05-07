<?php

namespace NextrasOrmTools\Commands;

use Nette\Neon\Neon;
use Nette\Utils\Strings;
use Nette\Utils\FileSystem;
use Nextras\Orm\StorageReflection\StringHelper;
use NextrasOrmTools\Helpers\Inflect;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ModelGeneratorCommand extends Command
{
    public function configure()
    {
        $this
            ->setName('generate:model')
            ->setDescription('Generate Entity, Mapper and Repository from templates')
            ->setDefinition(
                new InputDefinition([
                        new InputOption('tablename', '-t', InputOption::VALUE_REQUIRED),
                        new InputOption('config', '-c', InputOption::VALUE_OPTIONAL),
                        ]
                ));
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = Strings::firstUpper($input->getOption('tablename'));

        if (!empty($name)) {
            $path = __DIR__ . '/../../_output/' . StringHelper::underscore($name);

            $namespace = 'App\\Model\\Orm';
            if (!empty($input->getOption('config'))) {
                $config = FileSystem::read($input->getOption('config'));
                $config = Neon::decode($config);
                $namespace = $config['orm']['model'];
            }

            FileSystem::createDir($path);

            $output->writeln('Generate files for ' . $name);

            // Entity
            FileSystem::copy(__DIR__ . '/../Templates/TestEntity.php', $path . '/' . Inflect::singularize($name) . '.php');

            $data = FileSystem::read($path . '/' . Inflect::singularize($name) . '.php');
            $data = str_replace('TestEntity', Inflect::singularize($name), $data);
            $data = str_replace('OrmNamespace', $namespace, $data);
            FileSystem::write($path . '/' . Inflect::singularize($name) . '.php', $data);

            $output->writeln('Entity ' . Inflect::singularize($name) . ' was generated!');

            // Mapper
            FileSystem::copy(__DIR__ . '/../Templates/TestMapper.php', $path . '/' . $name . 'Mapper.php');

            $data = FileSystem::read($path . '/' . $name . 'Mapper.php');
            $data = str_replace('TestMapper', $name . 'Mapper', $data);
            $data = str_replace('OrmNamespace', $namespace, $data);
            FileSystem::write($path . '/' . $name . 'Mapper.php', $data);

            $output->writeln($name . 'Mapper was generated!');

            // Repository
            FileSystem::copy(__DIR__ . '/../Templates/TestRepository.php', $path . '/' . $name . 'Repository.php');

            $data = FileSystem::read($path . '/' . $name . 'Repository.php');
            $data = str_replace('TestRepository', $name . 'Repository', $data);
            $data = str_replace('TestEntity', Inflect::singularize($name), $data);
            $data = str_replace('OrmNamespace', $namespace, $data);
            FileSystem::write($path . '/' . $name . 'Repository.php', $data);

            $output->writeln($name . 'Repository was generated!');
        } else {
            $output->writeln('You must set name of model. Use -t <name>');
        }
    }
}