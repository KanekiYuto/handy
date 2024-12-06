<?php

namespace KanekiYuto\Handy\Cascade\Trait\Laravel;

use stdClass;
use ReflectionMethod;
use ReflectionException;
use Illuminate\Support\Str;
use function Laravel\Prompts\error;

trait Helper
{

    /**
     * 自动判断是否需要使用方法参数 [如果值不是默认的话]
     *
     * @param  string  $class
     * @param  string  $fn
     * @param  array   $params
     *
     * @return stdClass
     */
    protected function useParams(string $class, string $fn, array $params): stdClass
    {
        $validParams = [];

        $params = collect($params)->mapWithKeys(function (array $item, string $key) {
            $key = Str::of($key)->replace('$', '')->toString();

            return [$key => $item];
        })->all();

        try {
            $method = new ReflectionMethod($class, $fn);

            foreach ($method->getParameters() as $param) {
                $paramName = $param->getName();

                $key = isset($params['@quote' . $paramName]) ? '@quote' . $paramName : $paramName;

                if (!isset($params[$key])){
                    error('Cascade: error!!!');
                    return (object) $validParams;
                }

                // 如果有设置默认值并且与默认值相等则不会被载入
                if ($param->isOptional() && $params[$key] === $param->getDefaultValue()) {
                    continue;
                }

                $validParams[$key] = $params[$key];
            }
        } catch (ReflectionException $e) {
            error($e->getMessage());
        }

        return (object) $validParams;
    }

}