<?php

namespace KanekiYuto\Handy\Cascade;

use Closure;
use KanekiYuto\Handy\Cascade\Make\ModelMake;
use KanekiYuto\Handy\Cascade\Make\MigrationMake;
use KanekiYuto\Handy\Cascade\Make\EloquentTraceMake;

/**
 * Cascade
 *
 * @author KanekiYuto
 */
class Cascade
{

	/**
	 * 表名称
	 *
	 * @var string
	 */
	private string $withTableName;

	/**
	 * 表注释
	 *
	 * @var string
	 */
	private string $withTableComment;

	/**
	 * Blueprint
	 *
	 * @var Blueprint
	 */
	private Blueprint $blueprint;

	private ModelParams $modelParams;

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
	 * 配置信息
	 *
	 * @return static
	 */
	public static function configure(): static
	{
		return new self();
	}

	/**
	 * 设置 [Table]
	 *
	 * @param  string  $table
	 * @param  string  $comment
	 *
	 * @return Cascade
	 */
	public function withTable(
		string $table,
		string $comment = ''
	): static {
		$this->withTableName = $table;
		$this->withTableComment = $comment;

		return $this;
	}

	/**
	 * 设置 [Blueprint]
	 *
	 * @param  Closure  $callback
	 *
	 * @return Cascade
	 */
	public function withBlueprint(Closure $callback): static
	{
		$blueprint = new Blueprint(
			$this->withTableName,
			$this->withTableComment
		);

		$callback($blueprint);

		$this->blueprint = $blueprint;

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
	public function withModel(
		string $extends,
		bool $incrementing = false,
		bool $timestamps = false
	): static {
		$this->modelParams = (new ModelParams())
			->setExtends($extends)
			->setIncrementing($incrementing)
			->setTimestamps($timestamps);

		return $this;
	}

	/**
	 * 启动创建
	 *
	 * @return void
	 */
	public function create(): void
	{
		if (!isset($this->blueprint)) {
			return;
		}

		$blueprint = $this->blueprint;

		(new EloquentTraceMake($blueprint))->boot();
		(new MigrationMake($blueprint))->boot();

		if (isset($this->modelParams)) {
			(new ModelMake($blueprint, $this->modelParams))->boot();
		}
	}

}