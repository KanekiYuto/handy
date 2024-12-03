<?php

namespace KanekiYuto\Handy\Cascade;

use stdClass;

/**
 * 迁移参数
 *
 * @author KanekiYuto
 */
class MigrationParams
{

    /**
     * 函数名称
     *
     * @var string
     */
    private string $fn;

    /**
     * 传给函数的参数对象
     *
     * @var stdClass
     */
    private stdClass $params;

    /**
     * 是否使用它
     *
     * @var bool
    */
    private bool $use;

    /**
     * 索引
     *
     * @var int
    */
    private int $index;

    /**
     * get Params
     *
     * @return stdClass
     */
    public function getParams(): stdClass
    {
        return $this->params;
    }

    /**
     * set Params
     *
     * @param stdClass $params
     *
     * @return self
     */
    public function setParams(stdClass $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * get Fn
     *
     * @return string
     */
    public function getFn(): string
    {
        return $this->fn;
    }

    /**
     * set Fn
     *
     * @param string $fn
     *
     * @return MigrationParams
     */
    public function setFn(string $fn): self
    {
        $this->fn = $fn;

        return $this;
    }

    /**
     * is Use
     *
     * @return bool
     */
    public function isUse(): bool
    {
        return $this->use;
    }

    /**
     * set Use
     *
     * @param bool $use
     *
     * @return MigrationParams
     */
    public function setUse(bool $use): self
    {
        $this->use = $use;

        return $this;
    }

    /**
     * get Index
     *
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * set Index
     *
     * @param int $index
     *
     * @return MigrationParams
     */
    public function setIndex(int $index): self
    {
        $this->index = $index;

        return $this;
    }

}
