<?php

namespace KanekiYuto\Handy\Support\Facades;

use Closure;
use Illuminate\Support\Facades\Facade;
use \KanekiYuto\Handy\Preacher\Preacher as PreacherAlias;

/**
 * Preacher Facade
 *
 * @method static void useMessageActivity(Closure $closure)
 * @method static PreacherAlias base()
 * @method static PreacherAlias msg(string $msg)
 * @method static PreacherAlias code(int $code)
 * @method static PreacherAlias msgCode(int $code, string $msg)
 * @method static PreacherAlias paging(int $page, int $prePage, int $total, array $data)
 * @method static PreacherAlias receipt(object $data)
 * @method static PreacherAlias rows(array $data)
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
