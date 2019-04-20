<?php
declare(strict_types=1);

namespace Yokuru\SchemaCache;

use Doctrine\DBAL\Schema\Table;
use Illuminate\Database\DatabaseManager;
use Illuminate\Filesystem\Filesystem;

class SchemaService
{
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @var Filesystem
     */
    private $files;

    public function __construct(
        DatabaseManager $db,
        Filesystem $files
    ) {
        $this->db = $db;
        $this->files = $files;
    }

    /**
     * Describe tables from database
     * @return Table[]
     */
    public function describeTables(): array
    {
        return $this->isCached() ? $this->loadCachedSchema() : $this->selectSchema();
    }

    /**
     * Cache schema information to file
     */
    public function cacheSchema(): void
    {
        $this->files->put($this->getCachedSchemaPath(), serialize($this->selectSchema()));
    }

    /**
     * Clear cache file
     */
    public function clearCache(): void
    {
        $this->files->delete($this->getCachedSchemaPath());
    }

    /**
     * Load schema information from cached file
     * @return Table[]
     * @throws
     */
    private function loadCachedSchema(): array
    {
        return unserialize($this->files->get($this->getCachedSchemaPath()));
    }

    /**
     * Select schema information from database
     * @return Table[]
     * @throws
     */
    private function selectSchema(): array
    {
        return $this->db->getDoctrineSchemaManager()->listTables();
    }

    /**
     * @return bool
     */
    private function isCached(): bool
    {
        return $this->files->exists($this->getCachedSchemaPath());
    }

    /**
     * @return string
     */
    private function getCachedSchemaPath(): string
    {
        return app()->bootstrapPath('/cache/schema.php');
    }
}