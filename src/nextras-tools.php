<?php

require __DIR__ . '/../vendor/autoload.php';

$console = new \Symfony\Component\Console\Application('Nextras ORM Tools');
$console->addCommands([
        new \NextrasOrmTools\Commands\ModelGeneratorCommand(),
        new \NextrasOrmTools\Commands\DatabaseGeneratorCommand(),
]);
$console->run();
