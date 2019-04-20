<?php
declare(strict_types=1);

namespace Yokubo\SchemaCache\Commands;

use Illuminate\Console\Command;
use Yokubo\SchemaCache\SchemaService;

class SchemaCache extends Command
{
    protected $signature = 'schema:cache';
    protected $description = 'Create a scheme cache file';

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
        $this->call('schema:clear');
        $this->service->cacheSchema();
        $this->info('Schema cached successfully!');
    }
}
