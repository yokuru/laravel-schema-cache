<?php
declare(strict_types=1);

namespace Yokuru\SchemaCache\Command;

use Illuminate\Console\Command;
use Yokuru\SchemaCache\SchemaService;

class SchemaClear extends Command
{
    protected $signature = 'schema:clear';
    protected $description = 'Remove a scheme cache file';

    /**
     * @var SchemaService
     */
    private $service;

    public function __construct(SchemaService $schemaService)
    {
        parent::__construct();
        $this->service = $schemaService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service->clearCache();
        $this->info('Schema cache cleared!');
    }
}
