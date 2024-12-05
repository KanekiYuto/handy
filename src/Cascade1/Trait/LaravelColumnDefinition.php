<?php

namespace KanekiYuto\Handy\Cascade1\Trait;

use Illuminate\Contracts\Database\Query\Expression;
use KanekiYuto\Handy\Cascade1\ColumnDefinition;
use KanekiYuto\Handy\Cascade1\Constants\DefaultColumnParams;

trait LaravelColumnDefinition
{

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param bool $value
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function nullable(bool $value = true): self
    {
        $params = (object)[];

        if ($value !== true) {
            $params->value = $value;
        }

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string $comment
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function comment(string $comment): self
    {
        $this->columnParams->setComment($comment);

        $this->columnParams->setMigrationParam(__FUNCTION__, (object)[
            'comment' => $comment
        ]);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param bool $value
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function primary(bool $value = true): self
    {
        $params = (object)[];

        if ($value !== true) {
            $params->value = $value;
        }

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param bool|string|null $indexName
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function unique(bool|string|null $indexName = null): self
    {
        $params = (object)[];

        if ($indexName !== DefaultColumnParams::UNIQUE) {
            $params->indexName = $indexName;
        }

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param bool|string|null $indexName
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function index(bool|string|null $indexName = null): self
    {
        $params = (object)[];

        if ($indexName !== DefaultColumnParams::UNIQUE) {
            $params->indexName = $indexName;
        }

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string $column
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function after(string $column): self
    {
        $params = (object)[];

        $params->column = $column;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string|Expression $expression
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function storedAs(string|Expression $expression): self
    {
        $params = (object)[];

        $params->expression = $expression;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }


    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param mixed $value
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function default(mixed $value): self
    {
        $params = (object)[];

        $params->value = $value;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param int $startingValue
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function from(int $startingValue): self
    {
        $params = (object)[];

        $params->startingValue = $startingValue;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string $charset
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function charset(string $charset): self
    {
        $params = (object)[];

        $params->charset = $charset;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string|Expression $expression
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function virtualAs(string|Expression $expression): self
    {
        $params = (object)[];

        $params->expression = $expression;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string|Expression|null $expression
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function generatedAs(string|Expression $expression = null): self
    {
        $params = (object)[];

        if (!is_null($expression)) {
            $params->expression = $expression;
        }

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function unsigned(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function useCurrent(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function useCurrentOnUpdate(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function always(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function first(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function invisible(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @param string $collation
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function collation(string $collation): self
    {
        $params = (object)[];

        $params->collation = $collation;

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function autoIncrement(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

    /**
     * 与 Laravel ColumnDefinition 保持一致
     *
     * @return LaravelColumnDefinition|ColumnDefinition
     */
    public function change(): self
    {
        $params = (object)[];

        $this->columnParams->setMigrationParam(__FUNCTION__, $params);

        return $this;
    }

}
