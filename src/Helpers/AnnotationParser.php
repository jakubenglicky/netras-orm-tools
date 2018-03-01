<?php

namespace NextrasOrmTools\Helpers;

use NextrasOrmTools\TableDefinition;
use ReflectionClass;

class AnnotationParser
{
    /**
     * @var string
     */
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @throws \ReflectionException
     */
    public function getProperties():object
    {
        $ref = new ReflectionClass($this->class);
        $ann = $ref->getDocComment();

        $properties = explode('property', $ann);
        unset($properties[0]);
        $properties = array_splice($properties, 0);

        $result = null;
        $i = 0;
        foreach ($properties as $property) {

            $property = $this->clear($property);
            $partsOfProperty = explode(' ', $property);

            $parts = null;
            foreach ($partsOfProperty as $item) {
                $parts['type'] = $partsOfProperty[0];
                $parts['name'] = str_replace('$', '', $partsOfProperty[1]);

                if (isset($partsOfProperty[2])) {
                    $parts['detail'] = $partsOfProperty[2];
                } else {
                    $parts['detail'] = '';
                }

            }
            $result[$i] = $parts;
            $i = $i + 1;
        }

        $def = new TableDefinition();
        $def->setColumns($result);
        $def->setName($this->class);

        return $def;
    }

    protected function clear($string): string
    {
        $string = str_replace('*', '', $string);
        $string = str_replace('/', '', $string);
        $string = str_replace('@', '', $string);

        return trim($string);
    }
}
