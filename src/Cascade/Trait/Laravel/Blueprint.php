<?php

namespace KanekiYuto\Handy\Cascade\Trait\Laravel;

use KanekiYuto\Handy\Cascade\ColumnDefinition;
use KanekiYuto\Handy\Cascade\ColumnParams;
use ReflectionException;
use ReflectionMethod;
use stdClass;
use function Laravel\Prompts\error;

trait Blueprint
{

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int|null $length
     *
     * @return ColumnDefinition
     */
    public function string(string $column, int $length = null): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$length' => $length
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

    /**
     * 自动判断是否需要使用方法参数 [如果值不是默认的话]
     *
     * @param string $fn
     * @param array $params
     *
     * @return stdClass
     */
    protected function useParams(string $fn, array $params): stdClass
    {
        $validParams = [];

        try {
            $method = new ReflectionMethod(__CLASS__, $fn);

            foreach ($method->getParameters() as $param) {
                $paramName = $param->getName();
                $value = $params['$' . $paramName];

                if ($param->isOptional() && $value === $param->getDefaultValue()) {
                    continue;
                }

                $validParams[$paramName] = $value;
            }
        } catch (ReflectionException $e) {
            error($e->getMessage());
        }

        return (object)$validParams;
    }

    /**
     * 与 Laravel Blueprint 保持一致
     *
     * @param string $column
     * @param int|null $length
     * @param bool $fixed
     *
     * @return ColumnDefinition
     */
    public function binary(
        string $column,
        int    $length = null,
        bool   $fixed = false
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$length' => $length,
            '$fixed' => $fixed
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
    public function dateTimeTz(string $column, int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision,
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
    public function dateTime(string $column, int $precision = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$precision' => $precision,
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
     * @param int $total
     * @param int $places
     *
     * @return ColumnDefinition
     */
    public function decimal(
        string $column,
        int    $total = 8,
        int    $places = 2
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$total' => $total,
            '$places' => $places
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
     * @param array $allowed
     *
     * @return ColumnDefinition
     */
    public function enum(string $column, array $allowed): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$allowed' => $allowed
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
    public function float(string $column, int $precision = 53): ColumnDefinition
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
     * @param int $length
     *
     * @return ColumnDefinition
     */
    public function foreignUlid(string $column, int $length = 26): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$length' => $length
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
     * @param string|null $subtype
     * @param int $srid
     *
     * @return ColumnDefinition
     */
    public function geography(
        string $column,
        string $subtype = null,
        int    $srid = 4326
    ): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$subtype' => $subtype,
            '$srid' => $srid
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
     * @param string|null $subtype
     * @param int $srid
     *
     * @return ColumnDefinition
     */
    public function geometry(
        string $column,
        string $subtype = null,
        int    $srid = 0): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$subtype' => $subtype,
            '$srid' => $srid
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
     * @param array $allowed
     *
     * @return ColumnDefinition
     */
    public function set(string $column, array $allowed): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$allowed' => $allowed
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
     * @param int $length
     *
     * @return ColumnDefinition
     */
    public function ulid(string $column = 'ulid', int $length = 26): ColumnDefinition
    {
        $params = $this->useParams(__FUNCTION__, [
            '$column' => $column,
            '$length' => $length
        ]);

        $columnDefinition = new ColumnDefinition(
            (new ColumnParams($column))
                ->setMigrationParam(__FUNCTION__, $params)
        );

        return $this->addColumn($columnDefinition);
    }

}

