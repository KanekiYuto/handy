<?php

namespace KanekiYuto\Handy\Trace;

use ReflectionClass;

/**
 * 追踪 [laravel Eloquent ORM]
 *
 * @author KanekiYuto
 */
abstract class TraceEloquent
{

    /**
     * 获取所有列名称
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
     * 获取所有子类常量
     *
     * @return array
     */
    private static function getConstants(): array
    {
        return (new ReflectionClass(get_called_class()))
            ->getConstants();
    }

}
