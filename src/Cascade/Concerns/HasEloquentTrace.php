<?php

namespace KanekiYuto\Handy\Cascade\Concerns;

use KanekiYuto\Handy\Trace\EloquentTrace;

/**
 * 使用 [Eloquent Trace]
 *
 * @author KanekiYuto
 */
trait HasEloquentTrace
{

    /**
     *  [Eloquent Trace] 实例
     *
     * @var string
     */
    protected string $eloquentTrace = EloquentTrace::class;

    /**
     * 获取 [Eloquent Trace] 实例
     *
     * @return string
     */
    protected function getEloquentTrace(): string
    {
        return $this->eloquentTrace;
    }

    /**
     * 设置 [Eloquent Trace] 实例
     *
     * @param  string  $trace
     *
     * @return void
     */
    protected function setEloquentTrace(string $trace): void
    {
        $this->eloquentTrace = $trace;
    }

    /**
     * 获取 [Eloquent Trace] 实例表名称
     *
     * @return string
     */
    protected function getEloquentTable(): string
    {
        return $this->eloquentTrace::TABLE;
    }

    /**
     * 获取 [Eloquent Trace] 实例 - 隐藏列
     *
     * @return array<int, string>
     */
    protected function getEloquentHidden(): array
    {
        return $this->eloquentTrace::HIDDEN;
    }

    /**
     * 获取 [Eloquent Trace] 实例 - 可填充列
     *
     * @return array<int, string>
     */
    protected function getEloquentFillable(): array
    {
        return $this->eloquentTrace::FILLABLE;
    }

    /**
     * 获取 [Eloquent Trace] 实例 - 所有列
     *
     * @return array<int, string>
     */
    protected function getEloquentColumns(): array
    {
        return $this->eloquentTrace::getColumns();
    }

}