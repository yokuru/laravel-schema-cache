<?php
declare(strict_types=1);

namespace Yokuru\SchemaCache;

use Doctrine\DBAL\Schema\Table;

class SchemaHolder
{
    /**
     * @var Table[]
     */
    private $tables;

    /**
     * Set tables
     * @param Table[] $tables
     */
    public function setTables(array $tables): void
    {
        foreach ($tables as $table) {
            $this->tables[$table->getName()] = $table;
        }
    }

    /**
     * Get table
     * @param string $table
     * @return Table
     */
    public function getTable(string $table): Table
    {
        if (!isset($this->tables[$table])) {
            throw new \InvalidArgumentException("Table '{$table}'' is not found.");
        }

        return $this->tables[$table];
    }
}