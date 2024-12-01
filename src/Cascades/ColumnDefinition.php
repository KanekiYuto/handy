<?php

namespace KanekiYuto\Handy\Cascades;

use Closure;
use KanekiYuto\Handy\Cascades\Trait\LaravelColumnDefinition;

/**
 * 列定义
 *
 * @author KanekiTuto
 */
class ColumnDefinition
{

    use LaravelColumnDefinition;

    /**
     * 列参数
     *
     * @var ColumnParams
     */
    private ColumnParams $columnParams;

    /**
     * 构建一个新列迁移参数实例
     *
     * @param ColumnParams $columnParams
     *
     * @return void
     */
    public function __construct(ColumnParams $columnParams)
    {
        $this->columnParams = $columnParams;
    }

    /**
     * get Column Params
     *
     * @return ColumnParams
     */
    public function getColumnParams(): ColumnParams
    {
        return $this->columnParams;
    }

    /**
     * 标记为隐藏列
     *
     * @param bool $value
     *
     * @return self
     */
    public function hidden(bool $value = true): self
    {
        $this->columnParams->setHide($value);

        return $this;
    }

    /**
     * 指定转换类型
     *
     * @param Closure $value
     *
     * @return self
     */
    public function cast(Closure $value): self
    {
        $this->columnParams->setCast($value);

        return $this;
    }

}
