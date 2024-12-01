<?php

namespace KanekiYuto\Handy\Cascades;

use KanekiYuto\Handy\Cascades\Trait\Laravel\Time as LaravelBlueprintTime;
use KanekiYuto\Handy\Cascades\Trait\Laravel\Blueprint as LaravelBlueprint;
use KanekiYuto\Handy\Cascades\Trait\Laravel\Integer as LaravelBlueprintInteger;
use KanekiYuto\Handy\Cascades\Trait\Laravel\OnlyUseColumn as LaravelBlueprintOnlyUseColumn;

/**
 * 蓝图 - [Blueprint]
 *
 * [Builder] 在实际工作中会先构建 [Migration] 所需的列参数
 *
 * 然后再为其进行其他参数的构建，同时尽可能保证与原有方法使用一致
 *
 * @todo   暂且不支持的方法 [foreignIdFor | morphs | ulidMorphs | uuidMorphs | nullableTimestamps | nullableUlidMorphs]
 * @todo   暂且不支持的方法 [nullableUuidMorphs | rememberToken]
 *
 * @author KanekiTuto
 */
class Blueprint
{

	use LaravelBlueprint,
		LaravelBlueprintOnlyUseColumn,
		LaravelBlueprintInteger,
		LaravelBlueprintTime;

	/**
	 * 表名称
	 *
	 * @var string
	 */
	protected string $table;

	/**
	 * 备注
	 *
	 * @var string
	 */
	protected string $comment;

	/**
	 * 列信息定义
	 *
	 * @var ColumnDefinition[]
	 */
	protected array $columns = [];

	/**
	 * 主键是否自增
	 *
	 * @var bool
	 */
	protected static bool $incrementing = true;

	/**
	 * 指示模型是否主动维护时间戳
	 *
	 * @var bool
	 */
	protected static bool $timestamps = false;

	/**
	 * 构建一个新的蓝图实例
	 *
	 * @param  string  $table
	 * @param  string  $comment
	 *
	 * @return void
	 */
	public function __construct(string $table, string $comment = '')
	{
		$this->table = $table;
		$this->comment = $comment;
	}

	public static function test()
	{

	}

	/**
	 * 获取所有列信息
	 *
	 * @return ColumnDefinition[]
	 */
	public function getColumns(): array
	{
		return $this->columns;
	}

	/**
	 * 获取表名
	 *
	 * @return string
	 */
	public function getTable(): string
	{
		return $this->table;
	}

	/**
	 * 获取表说明
	 *
	 * @return string
	 */
	public function getComment(): string
	{
		return $this->comment;
	}

	/**
	 * 将列定义加入到数组中
	 *
	 * @param  ColumnDefinition  $columnDefinition
	 *
	 * @return ColumnDefinition
	 */
	protected function addColumn(ColumnDefinition $columnDefinition): ColumnDefinition
	{
		$this->columns[] = $columnDefinition;

		return $columnDefinition;
	}

}
