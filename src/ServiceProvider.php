<?php
declare(strict_types=1);

namespace Yokuru\SchemaCache;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as Provider;
use Yokuru\SchemaCache\Command\SchemaCache;
use Yokuru\SchemaCache\Command\SchemaClear;

class ServiceProvider extends Provider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(SchemaHolder::class, SchemaHolder::class);
    }

    public function boot()
    {
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

    public function provides()
    {
        return [
            SchemaService::class,
            SchemaHolder::class,
        ];
    }

}