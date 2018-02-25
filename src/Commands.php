<?php
/* Part of NextrasOrmTools */

namespace NextrasOrmTools;

use Inflect;
use Nette\Utils\Strings;

class Commands
{
    /**
     * Get title of app
     * @return string
     */
    public static function getTitle()
    {
        $output = 'Nextras Orm Tools' . PHP_EOL;
        $output .= '=================' . PHP_EOL;

        return $output;
    }

    /**
     * Get options of app
     * @return string
     */
    public static function getOptions()
    {
        $output = 'Commands:' . PHP_EOL;
        $output .= '    generate:model <name> -n <orm-namespace>' . PHP_EOL;
        $output .= '                   - Generate Entity, Mapper and Repository from templates' . PHP_EOL;

        return $output;
    }

    /**
     * Command for generate files from templates
     * @param $nameOfRepository
     * @param $namespace
     */
    public static function generateCommand($nameOfRepository, $namespace)
    {
        $name = Strings::firstUpper($nameOfRepository);
        $path = __DIR__ . '/../_output/' . $name;

        @mkdir(Strings::lower($path));

        CommandLine::writeln('Generate files for ' . $name);
        // Entity
        copy(__DIR__ . '/Templates/TestEntity.php', $path . '/' . Inflect::singularize($name) . '.php');

        $data = file_get_contents($path . '/' . Inflect::singularize($name) . '.php');
        $data = str_replace('TestEntity', Inflect::singularize($name), $data);
        $data = str_replace('OrmNamespace', $namespace, $data);
        file_put_contents($path . '/' . Inflect::singularize($name)  . '.php', $data);

        CommandLine::writeln('Entity is generated!');


        // Mapper
        copy(__DIR__ . '/Templates/TestMapper.php', $path . '/' . $name . 'Mapper.php');

        $data = file_get_contents($path . '/' . $name . 'Mapper.php');
        $data = str_replace('TestMapper', $name . 'Mapper', $data);
        $data = str_replace('OrmNamespace', $namespace, $data);
        file_put_contents($path . '/' . $name . 'Mapper.php', $data);

        CommandLine::writeln('Mapper is generated!');

        // Repository
        copy(__DIR__ . '/Templates/TestRepository.php', $path . '/' . $name . 'Repository.php');

        $data = file_get_contents($path . '/' . $name . 'Repository.php');
        $data = str_replace('TestRepository', $name . 'Repository', $data);
        $data = str_replace('TestEntity', Inflect::singularize($name), $data);
        $data = str_replace('OrmNamespace', $namespace, $data);
        file_put_contents($path . '/' . $name . 'Repository.php', $data);

        CommandLine::writeln('Repository is generated!');
        CommandLine::writeln(PHP_EOL);
    }
}