<?php

namespace App\Filament;

use Filament\Resources\RelationManagers\RelationManager;
use ReflectionClass;
use ReflectionException;

class BaseRelationManager extends RelationManager
{
    protected static ?string $model = null;

    /**
     * @throws ReflectionException
     */
    protected static function getModelClassName(): string
    {
        $class = new ReflectionClass(static::$model);
        return $class->getShortName();
    }

    public static function getRelationshipName(): string
    {
        return app(static::$model)->getTable();
    }

    /**
     * @throws ReflectionException
     */
    public static function getModelLabel(): string
    {
        $className = static::getModelClassName();
        return __("{$className}_label");
    }

    /**
     * @throws ReflectionException
     */
    public static function getPluralModelLabel(): string
    {
        $className = static::getModelClassName();
        return __("{$className}_plural_label");
    }
}
