<?php

namespace KanekiYuto\Handy\Cascade;

use Closure;
use KanekiYuto\Handy\Cascade\Params\Column as ColumnParams;

class ColumnDefinition
{

	private ColumnParams $columnParams;

	public function __construct(ColumnParams $columnParams)
	{
		$this->columnParams = $columnParams;
	}

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
	 * 标记为隐藏列
	 *
	 * @param  bool  $value
	 *
	 * @return ColumnDefinition
	 */
	public function hidden(bool $value = true): static
	{
		$this->columnParams->setHide($value);

		return $this;
	}

	/**
	 * 指定转换类型
	 *
	 * @param  Closure|string  $value
	 *
	 * @return ColumnDefinition
	 */
	public function cast(Closure|string $value): static
	{
		if (!is_string($value)) {
			$value = $value();
		}

		$this->columnParams->setCast($value);

		return $this;
	}

}