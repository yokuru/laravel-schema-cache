<?php
declare(strict_types=1);

namespace Yokuru\SchemaCacheTests\Facade;

use Yokuru\SchemaCache\Facade\SchemaCache;
use Yokuru\SchemaCache\SchemaHolder;
use Yokuru\SchemaCacheTests\TestCase;

class SchemaCacheTest extends TestCase
{

    public function test()
    {
        $this->assertTrue(SchemaCache::getFacadeRoot() instanceof SchemaHolder);
    }
}
