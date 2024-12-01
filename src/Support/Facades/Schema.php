<?php

namespace KanekiYuto\Handy\Support\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;

/**
 * Schema
 *
 * @method static void create(string $table, Closure $callback, bool $migration = false, string $comment = '')
 * @method static void dropIfExists(string $table)
 *
 * @see \KanekiYuto\Handy\Cascades\Builder
 *
 * @author KanekiTuto
 */
class Schema extends Facade
{

    /**
     * Facade 访问名称
     *
     * @var string
     */
    const FACADE_ACCESSOR = 'diverse.db.schema';

    /**
     * 指示是否应缓存已解析的 Facade
     *
     * @var bool
     */
    protected static $cached = false;

    /**
     * 获取组件的注册名称
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return self::FACADE_ACCESSOR;
    }

}
