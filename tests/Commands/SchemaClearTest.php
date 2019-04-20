<?php
declare(strict_types=1);

namespace Yokuru\SchemaCacheTests\Commands;

use Doctrine\DBAL\Schema\Table;
use Yokuru\SchemaCache\SchemaService;
use Yokuru\SchemaCache\ServiceProvider;
use Yokuru\SchemaCacheTests\TestCase;

class SchemaClearTest extends TestCase
{

    public function testSchemaClear()
    {
        $this->artisan('schema:clear')
            ->expectsOutput('Schema cache cleared!');
    }

    protected function getPackageProviders($app)
    {
        $schemaServiceMock = \Mockery::mock(SchemaService::class)->makePartial();
        $schemaServiceMock->shouldReceive('describeTables')->andReturn([
            new Table('test')
        ]);

        // It should be called `cacheSchema`
        $schemaServiceMock->shouldReceive('clearCache')->once()->andReturn(null);
        $app->instance(SchemaService::class, $schemaServiceMock);

        return [ServiceProvider::class];
    }
}
