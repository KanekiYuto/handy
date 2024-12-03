<?php

namespace KanekiYuto\Handy\Foundation\Cast;

use Exception;
use DateTimeZone;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use KanekiYuto\Diverse\Support\IdeIgnore;

/**
 * Automatic time zone switching
 *
 * @author KanekiYuto
 */
class AutoTimezone
{

    /**
     * The extracted data is converted
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
     * Convert to a value that will be stored
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
