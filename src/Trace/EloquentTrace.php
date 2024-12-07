<?php

namespace KanekiYuto\Handy\Trace;

use ReflectionClass;

/**
 * Trace [laravel Eloquent ORM]
 *
 * @author KanekiYuto
 */
class EloquentTrace
{

    /**
     * 表名称
     *
     * @var string
     */
    const TABLE = '';

    /**
     * 隐藏的属性
     *
     * @var array<int, string>
     */
    const HIDDEN = [];

    /**
     * 可填充的属性
     *
     * @var array<int, string>
     */
    const FILLABLE = [];

    /**
     * 获取所有列名称
     *
     * @return array
     */
    public static function getColumns(): array
    {
        $constants = self::getConstants();

        return array_filter($constants, function (string $key) {
            return !in_array($key, ['TABLE', 'HIDDEN', 'FILLABLE']);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * 获取所有子类常量
     *
     * @return array
     */
    private static function getConstants(): array
    {
        return (new ReflectionClass(get_called_class()))->getConstants();
    }

}