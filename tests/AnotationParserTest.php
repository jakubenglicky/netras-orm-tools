<?php

namespace NextrasOrmTools\Tests;


use NextrasOrmTools\Helpers\AnnotationParser;
use NextrasOrmTools\TableDefinition;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/bootstrap.php';

/**
 * @testCase
 */
class AnotationParserTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testReturnInstance()
    {
        $ann = new AnnotationParser('OrmNamespace\TestEntity');

        Assert::true($ann->getProperties() instanceof TableDefinition);
    }
}

(new AnotationParserTest())->run();