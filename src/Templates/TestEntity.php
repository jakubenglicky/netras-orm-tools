<?php

namespace OrmNamespace;

use Nextras\Orm\Entity\Entity;

/**
 * Class TestEntity
 *
 * @package  OrmNamespace
 * @property int $id {primary}
 * @property string $title
 */
class TestEntity extends Entity
{

    protected $test;
}
