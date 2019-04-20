<?php
declare(strict_types=1);

namespace Yokubo\SchemaCache;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as Provider;
use Yokubo\SchemaCache\Commands\SchemaCache;
use Yokubo\SchemaCache\Commands\SchemaClear;

class ServiceProvider extends Provider implements DeferrableProvider
{

    public function register()
    {
        $this->app->singleton(SchemaHolder::class, SchemaHolder::class);
        $this->app->bind(SchemaService::class, SchemaService::class);
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