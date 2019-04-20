<?php
declare(strict_types=1);

namespace Yokuru\SchemaCache\Facade;

use Yokuru\SchemaCache\SchemaHolder;

/**
 * @method static \Doctrine\DBAL\Schema\Table getTable(string $table)
 * @see \Yokuru\SchemaCache\SchemaHolder
 */
class SchemaCache extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return SchemaHolder::class;
    }
}
