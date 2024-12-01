<?php

namespace KanekiYuto\Handy\Preacher;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * 导出数据 @todo 需要修改
 *
 * @author KanekiYuto
 */
readonly class Export
{
    
    /**
     * 构造导出实例
     *
     * @param  array  $data
     */
    public function __construct(
        private array $data = []
    ) {
        // ...
    }
    
    /**
     * 以 [array] 形式导出
     *
     * @return array
     */
    public function array(): array
    {
        return $this->data;
    }
    
    /**
     * 以 [json] 形式导出
     *
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     *
     * @return JsonResponse
     */
    public function json(
        int $status = Preacher::DEFAULT_HTTP_STATUS,
        array $headers = [],
        int $options = Preacher::DEFAULT_JSON_OPTIONS
    ): JsonResponse {
        return Response::json(
            self::array(),
            $status,
            $headers,
            $options
        );
    }
    
    /**
     * 以 [jsonp] 形式导出
     *
     * @param  string|null  $callback
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     *
     * @return JsonResponse
     */
    public function jsonp(
        string|null $callback = null,
        int $status = Preacher::DEFAULT_HTTP_STATUS,
        array $headers = [],
        int $options = Preacher::DEFAULT_JSON_OPTIONS
    ): JsonResponse {
        return Response::jsonp(
            $callback,
            self::array(),
            $status,
            $headers,
            $options
        );
    }
    
}