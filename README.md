Laravel Schema Cache
===

A database schema loading and caching library for [Laravel](https://laravel.com/).


## Installation

With [Composer](https://getcomposer.org/):

```
composer require yokuru/laravel-schema-cache
```

## Usage

You can now get schema information using Facade.  
It it wrapper of [Doctrine DBAL](https://www.doctrine-project.org/projects/dbal.html) schema manager.

~~~
SchemaCache::getTable('table_name');
~~~

## Commands

When deploying your application to production, I recommend caching schema.


Cache schema:

```
php artisan schema:cache
```

Clear cache:

```
php artisan schema:clear
```


## License

MIT