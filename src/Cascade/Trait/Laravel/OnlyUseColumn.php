<?php

namespace KanekiYuto\Handy\Cascade\Trait\Laravel;

use KanekiYuto\Handy\Cascade\ColumnParams;
use KanekiYuto\Handy\Cascade\ColumnDefinition;

trait OnlyUseColumn
{

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function bigIncrements(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 当只有 [column] 参数时使用
	 *
	 * @param  string  $column
	 * @param  string  $fn
	 *
	 * @return ColumnDefinition
	 */
	protected function onlyUseColumn(string $column, string $fn): ColumnDefinition
	{
		$params = [];

		$fnDefault = [
			'id' => 'id',
			'ipAddress' => 'ip_address',
			'macAddress' => 'mac_address',
			'uuid' => 'uuid',
		];

		if (!in_array($fn, array_keys($fnDefault))) {
			$params['column'] = $column;
		} elseif (!isset($fnDefault[$fn])) {
			$params['column'] = $column;
		} elseif ($column !== $fnDefault[$fn]) {
			$params['column'] = $column;
		}

		$columnDefinition = new ColumnDefinition(
			(new ColumnParams($column))
				->setMigrationParam($fn, (object) $params)
		);

		return $this->addColumn($columnDefinition);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function boolean(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function date(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function double(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function foreignId(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function foreignUuid(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function id(string $column = 'id'): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function increments(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function ipAddress(string $column = 'ip_address'): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function json(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function jsonb(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function longText(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function macAddress(string $column = 'mac_address'): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function mediumIncrements(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function mediumText(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function smallIncrements(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function text(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function tinyIncrements(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function tinyText(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function uuid(string $column = 'uuid'): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string  $column
	 *
	 * @return ColumnDefinition
	 */
	public function year(string $column): ColumnDefinition
	{
		return $this->onlyUseColumn($column, __FUNCTION__);
	}

}
