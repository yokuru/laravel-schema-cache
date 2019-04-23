<?php
declare(strict_types=1);

namespace Yokuru\SchemaCacheTests;

use Doctrine\DBAL\Schema\Table;
use Yokuru\SchemaCache\SchemaHolder;

class SchemaHolderTest extends TestCase
{

    public function testAccessors()
    {
        $tables = [
            new Table('test1'),
            new Table('test2'),
        ];

        $target = new SchemaHolder();
        $target->setTables($tables);
        $this->assertSame($tables[0], $target->getTable('test1'));
        $this->assertSame($tables[1], $target->getTable('test2'));

        $actualTables = $target->getTables();
        $this->assertEquals(2, count($actualTables));
        $this->assertSame($tables[0], $actualTables['test1']);
        $this->assertSame($tables[1], $actualTables['test2']);
    }

    /**
     * It should throw exception when the table doesn't exists
     */
    public function testNotFoundTable()
    {
        $this->expectException(\InvalidArgumentException::class);

        $target = new SchemaHolder();
        $target->getTable('not_exists_table');
    }
}