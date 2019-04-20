<?php
declare(strict_types=1);

namespace Yokuru\SchemaCacheTests;

use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\Filesystem;
use Mockery\MockInterface;
use Yokuru\SchemaCache\SchemaService;

class SchemaServiceTest extends TestCase
{
    /**
     * @var SchemaService
     */
    private $target;

    /**
     * @var MockInterface
     */
    private $dbMock;

    /**
     * @var MockInterface
     */
    private $filesMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dbMock = \Mockery::mock(DatabaseManager::class)->makePartial();
        $this->instance(DatabaseManager::class, $this->dbMock);

        $this->filesMock = \Mockery::mock(Filesystem::class)->makePartial();
        $this->instance(Filesystem::class, $this->filesMock);

        $this->target = $this->app->make(SchemaService::class);
    }

    /**
     * It should describe table when the cache file doesn't exists
     */
    public function testDescribeTable()
    {
        $expected = ['test', 'array'];

        $this->filesMock
            ->shouldReceive('exists')
            ->andReturn(true);

        $this->filesMock
            ->shouldReceive('get')
            ->andReturn(serialize($expected));

        $this->assertEquals($expected, $this->target->describeTables());
    }

    /**
     * It should load cache when the cache file does exists
     */
    public function testDescribeTableWithCache()
    {
        $this->filesMock
            ->shouldReceive('exists')
            ->andReturn(false);

        $this->dbMock
            ->shouldReceive('getDoctrineSchemaManager')
            ->once()
            ->andReturn(new class {
                public function listTables() {
                    return ['test', 'array'];
                }
            });

        $this->assertEquals(['test', 'array'], $this->target->describeTables());
    }

    /**
     * It should be called file put
     */
    public function testCacheSchema()
    {
        $expectedSchema = serialize(['test', 'array']);

        $this->dbMock
            ->shouldReceive('getDoctrineSchemaManager')
            ->once()
            ->andReturn(new class {
                public function listTables() {
                    return ['test', 'array'];
                }
            });

        $this->filesMock
            ->shouldReceive('put')
            ->once()
            ->with($this->app->bootstrapPath('/cache/schema.php'), $expectedSchema);

        $this->target->cacheSchema();
    }

    /**
     * It should be called file delete
     */
    public function testClearCache()
    {
        $this->filesMock
            ->shouldReceive('delete')
            ->once()
            ->with($this->app->bootstrapPath('/cache/schema.php'));

        $this->target->clearCache();
    }
}