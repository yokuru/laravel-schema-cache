<?php
declare(strict_types=1);

namespace Yokubo\SchemaCache;

use Illuminate\Support\ServiceProvider as Provider;
use Yokubo\SchemaCache\Commands\SchemaCache;
use Yokubo\SchemaCache\Commands\SchemaClear;

class ServiceProvider extends Provider
{

    public function register()
    {
        $this->app->singleton(SchemaHolder::class, SchemaHolder::class);
        $this->app->bind(SchemaService::class, SchemaService::class);
    }

    public function boot()
    {
        echo "SchemaCacheServiceProvider";
        if ($this->app->runningInConsole()) {
            $this->commands([
                SchemaCache::class,
                SchemaClear::class,
            ]);
        }

        $schemaService = $this->app->make(SchemaService::class);
        $schemaHolder = $this->app->make(SchemaHolder::class);
        $schemaHolder->setTables($schemaService->describeTables());
    }

}