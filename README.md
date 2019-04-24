Laravel Schema Cache
===

[![Build Status](https://travis-ci.org/yokuru/laravel-schema-cache.svg?branch=master)](https://travis-ci.org/yokuru/laravel-schema-cache)
[![Coverage Status](https://coveralls.io/repos/github/yokuru/laravel-schema-cache/badge.svg?branch=feature%2Fcoverage)](https://coveralls.io/github/yokuru/laravel-schema-cache?branch=feature%2Fcoverage)
[![MIT License](http://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)

A database schema loading and caching library for [Laravel](https://laravel.com/).

test

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
