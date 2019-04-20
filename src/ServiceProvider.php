<?php
declare(strict_types=1);

namespace Yokubo\SchemaCache;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{

    public function register()
    {
        $this->app->singleton(SchemaHolder::class, SchemaHolder::class);
        $this->app->bind(SchemaService::class, SchemaService::class);
    }

    public function boot()
    {
        $schemaService = $this->app->make(SchemaService::class);
        $schemaHolder = $this->app->make(SchemaHolder::class);
        $schemaHolder->setTables($schemaService->describeTables());
    }

}