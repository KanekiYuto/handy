<?php

namespace KanekiYuto\Handy\Cascade\Trait\Laravel;

use KanekiYuto\Handy\Cascade\ColumnDefinition;
use KanekiYuto\Handy\Cascade\ColumnParams;

trait Time
{

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int $precision
     *
     * @return ColumnDefinition
     */
    public function softDeletes(string $column = 'deleted_at', int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int $precision
     *
     * @return ColumnDefinition
     */
    public function softDeletesTz(string $column = 'deleted_at', int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int $precision
     *
     * @return ColumnDefinition
     */
    public function timeTz(string $column, int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int $precision
     *
     * @return ColumnDefinition
     */
    public function time(string $column, int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int $precision
     *
     * @return ColumnDefinition
     */
    public function timestampTz(string $column, int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int $precision
     *
     * @return ColumnDefinition
     */
    public function timestamp(string $column, int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

}
