<?php

namespace KanekiYuto\Handy\Support\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use KanekiYuto\Handy\Preacher\PreacherResponse;

/**
 * Preacher Facade
 *
 * @method static void useMessageActivity(Closure $closure)
 * @method static PreacherResponse base()
 * @method static PreacherResponse msg(string $msg)
 * @method static PreacherResponse code(int $code)
 * @method static PreacherResponse msgCode(int $code, string $msg)
 * @method static PreacherResponse paging(int $page, int $prePage, int $total, array $data)
 * @method static PreacherResponse receipt(object $data)
 * @method static PreacherResponse rows(array $data)
 * @method static PreacherResponse allow(bool $allow, mixed $pass, mixed $noPass, callable $handle = null)
 *
 * @see \KanekiYuto\Handy\Preacher\Builder
 *
 * @author KanekiTuto
 */
class Preacher extends Facade
{

    /**
     * Facade 访问名称
     *
     * @var string
     */
    const FACADE_ACCESSOR = 'handy.preacher';

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
