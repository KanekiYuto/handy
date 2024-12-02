<?php

namespace KanekiYuto\Handy\Cascades\Casts;

use DateTimeImmutable;
use DateTimeZone;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use KanekiYuto\Diverse\Support\IdeIgnore;

/**
 * 自动的时区转换
 *
 * @todo 需要转移一个包 (IdeIgnore)
 *
 * @author KanekiYuto
 */
class AutoTimezone
{

    /**
     * 将取出的数据进行转换
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): string
    {
        IdeIgnore::noUseParam($model, $key, $attributes);
        $timezone = Request::header('timezone');

        try {
            return (new DateTimeImmutable())
                ->setTimestamp($value)
                ->setTimezone(new DateTimeZone($timezone))
                ->format('Y-m-d H:i:s');
        } catch (Exception) {
            return date('Y-m-d H:i:s', $value);
        }
    }

    /**
     * 转换成将要进行存储的值
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return int
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): int
    {
        IdeIgnore::noUseParam($model, $key, $attributes);

        return (int) $value;
    }

}
