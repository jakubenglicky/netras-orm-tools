<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Helpers/Inflect.php';
require __DIR__ . '/CommandLine.php';
require __DIR__ . '/Commands.php';
require __DIR__ . '/CliRunner.php';

$runner = new \NextrasOrmTools\CliRunner();
$runner->run();