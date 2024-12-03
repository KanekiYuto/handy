<?php

namespace KanekiYuto\Handy\Trace;

use ReflectionClass;

/**
 * Trace [laravel Eloquent ORM]
 *
 * @author KanekiYuto
 */
abstract class TraceEloquent
{

    /**
     * Gets all column names [hidden and table not included]
     *
     * @return array
     */
    public static function getAllColumns(): array
    {
        $constants = self::getConstants();

        return array_filter($constants, function (string $key) {
            return !in_array($key, ['TABLE', 'HIDDEN']);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Gets all subclass constants
     *
     * @return array
     */
    private static function getConstants(): array
    {
        return (new ReflectionClass(get_called_class()))
            ->getConstants();
    }

}
