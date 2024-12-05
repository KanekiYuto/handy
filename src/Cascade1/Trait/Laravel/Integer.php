<?php

namespace KanekiYuto\Handy\Cascade1\Trait\Laravel;

use KanekiYuto\Handy\Cascade1\ColumnDefinition;
use KanekiYuto\Handy\Cascade1\ColumnParams;
use KanekiYuto\Handy\Cascade1\Constants\ColumnTypeConstant;

trait Integer
{

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     * @param bool $unsigned
     *
     * @return ColumnDefinition
     */
    public function smallInteger(
        string $column,
        bool   $autoIncrement = false,
        bool   $unsigned = false
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement,
            '$unsigned' => $unsigned
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
     * @param bool $autoIncrement
     * @param bool $unsigned
     *
     * @return ColumnDefinition
     */
    public function mediumInteger(
        string $column,
        bool   $autoIncrement = false,
        bool   $unsigned = false
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement,
            '$unsigned' => $unsigned
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
     * @param bool $autoIncrement
     * @param bool $unsigned
     *
     * @return ColumnDefinition
     */
    public function integer(
        string $column,
        bool   $autoIncrement = false,
        bool   $unsigned = false
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement,
            '$unsigned' => $unsigned
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
     * @param bool $autoIncrement
     * @param bool $unsigned
     *
     * @return ColumnDefinition
     */
    public function bigInteger(
        string $column,
        bool   $autoIncrement = false,
        bool   $unsigned = false
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement,
            '$unsigned' => $unsigned
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     * @param bool $unsigned
     *
     * @return ColumnDefinition
     */
    public function tinyInteger(
        string $column,
        bool   $autoIncrement = false,
        bool   $unsigned = false
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement,
            '$unsigned' => $unsigned
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     *
     * @return ColumnDefinition
     */
    public function unsignedBigInteger(string $column, bool $autoIncrement = false): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     *
     * @return ColumnDefinition
     */
    public function unsignedInteger(string $column, bool $autoIncrement = false): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     *
     * @return ColumnDefinition
     */
    public function unsignedMediumInteger(string $column, bool $autoIncrement = false): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     *
     * @return ColumnDefinition
     */
    public function unsignedSmallInteger(string $column, bool $autoIncrement = false): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param bool $autoIncrement
     *
     * @return ColumnDefinition
     */
    public function unsignedTinyInteger(string $column, bool $autoIncrement = false): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$autoIncrement' => $autoIncrement
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(ColumnTypeConstant::STRING, $params)
        );

        return $this->addColumn($columnDefinition);
    }

}
