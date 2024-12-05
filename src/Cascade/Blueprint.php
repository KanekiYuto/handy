<?php

namespace KanekiYuto\Handy\Cascade;

use KanekiYuto\Handy\Cascade\Params\Column as ColumnParams;
use KanekiYuto\Handy\Cascade\Trait\Migration as MigrationTrait;
use KanekiYuto\Handy\Cascade\Params\Blueprint as BlueprintParams;
use KanekiYuto\Handy\Cascade\Params\Migration as MigrationParams;

class Blueprint
{

	use MigrationTrait;

	private BlueprintParams $blueprintParams;

	public function __construct(BlueprintParams $blueprintParams)
	{
		$this->blueprintParams = $blueprintParams;
	}

	/**
	 * 与 Laravel Blueprint 保持一致
	 *
	 * @param  string    $column
	 * @param  int|null  $length
	 *
	 * @return ColumnDefinition
	 */
	public function string(string $column, int $length = null): ColumnDefinition
	{
		$params = $this->useParams(__FUNCTION__, [
			'$column' => $column,
			'$length' => $length,
		]);

		$columnParams = (new ColumnParams($column))
			->addMigrationParams(new MigrationParams(__FUNCTION__, $params));

		$this->blueprintParams->addColumn($columnParams);

		return new ColumnDefinition($columnParams);
	}

}