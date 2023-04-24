<?php

namespace App\Filament;

use Filament\Resources\Resource;
use ReflectionClass;
use ReflectionException;

class BaseResource extends Resource
{
    /**
     * @throws ReflectionException
     */
    protected static function getModelClassName(): string
    {
        $class = new ReflectionClass(static::$model);
        return $class->getShortName();
    }

    /**
     * @throws ReflectionException
     */
    public static function getSlug(): string
    {
        $className = static::getModelClassName();
        return __("{$className}_plural_label");
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
