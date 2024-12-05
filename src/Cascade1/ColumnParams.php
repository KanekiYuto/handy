<?php

namespace KanekiYuto\Handy\Cascade1;

use Closure;
use stdClass;

/**
 * 列参数
 *
 * @author KanekiTuto
 */
class ColumnParams
{

	/**
	 * 字段名称
	 *
	 * @var string
	 */
	private string $field;

	/**
	 * 说明
	 *
	 * @var string
	 */
	private string $comment = '';

	/**
	 * 迁移参数
	 *
	 * @var MigrationParams[]
	 */
	private array $migrationParams = [];

	/**
	 * 是否隐藏该列
	 *
	 * @var bool
	 */
	private bool $hide = false;

	/**
	 * 转换类型
	 *
	 * @var string
	 */
	private string $cast = '';

	/**
	 * 构建一个列参数实例
	 *
	 * @param  string  $field
	 */
	public function __construct(string $field)
	{
		$this->field = $field;
	}

	/**
	 * get Migration Params
	 *
	 * @return MigrationParams[]
	 */
	public function getMigrationParams(): array
	{
		return $this->migrationParams;
	}

	/**
	 * set Migration Param
	 *
	 * @param  string    $fn
	 * @param  stdClass  $params
	 * @param  bool      $use
	 *
	 * @return self
	 */
	public function setMigrationParam(string $fn, stdClass $params, bool $use = true): self
	{
		$this->migrationParams[] = (new MigrationParams())
			->setFn($fn)
			->setParams($params)
			->setUse($use)
			->setIndex(count($this->migrationParams));

		return $this;
	}

	/**
	 * get Field
	 *
	 * @return string
	 */
	public function getField(): string
	{
		return $this->field;
	}

	/**
	 * get Comment
	 *
	 * @return string
	 */
	public function getComment(): string
	{
		return $this->comment;
	}

	/**
	 * set Comment
	 *
	 * @param  string  $comment
	 *
	 * @return self
	 */
	public function setComment(string $comment): self
	{
		$this->comment = $comment;

		return $this;
	}

	/**
	 * is Hide
	 *
	 * @return bool
	 */
	public function isHide(): bool
	{
		return $this->hide;
	}

	/**
	 * set Hide
	 *
	 * @param  bool  $hide
	 *
	 * @return self
	 */
	public function setHide(bool $hide): self
	{
		$this->hide = $hide;

		return $this;
	}

	/**
	 * get Casts
	 *
	 * @return string
	 */
	public function getCast(): string
	{
		return $this->cast;
	}

	/**
	 * set Casts
	 *
	 * @param  Closure  $cast
	 *
	 * @return self
	 */
	public function setCast(Closure $cast): self
	{
		$this->cast = $cast();

		return $this;
	}

}
