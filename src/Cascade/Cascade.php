<?php

namespace KanekiYuto\Handy\Cascade;

use Closure;
use KanekiYuto\Handy\Cascade\Params\Model as ModelParams;
use KanekiYuto\Handy\Cascade\Params\Blueprint as BlueprintParams;
use KanekiYuto\Handy\Cascade\Params\DatabaseTable as DatabaseTableParams;


/**
 * Cascade
 *
 * @author KanekiYuto
 */
class Cascade
{

	private DatabaseTableParams $tableParams;

	private ModelParams $modelParams;

	private BlueprintParams $blueprintParams;

	/**
	 * 配置信息
	 *
	 * @return static
	 */
	public static function configure(): static
	{
		return new static();
	}

	/**
	 * 创建一个 [Cascade] 实例
	 *
	 * @return void
	 */
	private function __construct()
	{
		// Do it...
	}

	/**
	 * 设置 - 【Table】
	 *
	 * @param  string  $table
	 * @param  string  $comment
	 *
	 * @return Cascade
	 */
	public function withTable(string $table, string $comment = ''): static
	{
		$this->tableParams = new DatabaseTableParams($table, $comment);

		return $this;
	}

	/**
	 * 设置 - [Model]
	 *
	 * @param  string  $extends
	 * @param  bool    $incrementing
	 * @param  bool    $timestamps
	 *
	 * @return Cascade
	 */
	public function withModel(string $extends, bool $incrementing = false, bool $timestamps = false): static
	{
		$this->modelParams = new ModelParams(
			$extends,
			$incrementing,
			$timestamps
		);

		return $this;
	}

	/**
	 * 设置 - [Blueprint]
	 *
	 * @param  Closure  $callable
	 *
	 * @return Cascade
	 */
	public function withBlueprint(Closure $callable): static
	{
		if (!isset($this->tableParams)) {
			return $this;
		}

		$this->blueprintParams = new BlueprintParams(
			$this->tableParams->getTable(),
			$this->tableParams->getComment(),
			$callable,
		);

		return $this;
	}

	public function create(): void
	{
		$blueprintCallable = $this->blueprintParams->getCallable();

		$blueprintCallable(new Blueprint($this->blueprintParams));
	}

}