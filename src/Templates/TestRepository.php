<?php

namespace OrmNamespace;

use Nextras\Orm\Repository\Repository;

class TestRepository extends Repository
{
    public static function getEntityClassNames(): array
    {
        return [TestEntity::class];
    }
}
