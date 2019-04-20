<?php
declare(strict_types=1);

namespace Yokuru\SchemaCacheTests\Commands;

use Doctrine\DBAL\Schema\Table;
use Yokuru\SchemaCache\SchemaService;
use Yokuru\SchemaCache\ServiceProvider;
use Yokuru\SchemaCacheTests\TestCase;

class SchemaCacheTest extends TestCase
{

    public function testSchemaCache()
    {
        $this->artisan('schema:cache')
            ->expectsOutput('Schema cached successfully!');
    }

    protected function getPackageProviders($app)
    {
        $schemaServiceMock = \Mockery::mock(SchemaService::class)->makePartial();
        $schemaServiceMock->shouldReceive('describeTables')->andReturn([
            new Table('test')
        ]);
        $schemaServiceMock->shouldReceive('clearCache')->andReturn(null);

        // It should be called `cacheSchema`
        $schemaServiceMock->shouldReceive('cacheSchema')->once()->andReturn(null);
        $app->instance(SchemaService::class, $schemaServiceMock);

        return [ServiceProvider::class];
    }
}
