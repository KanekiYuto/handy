<?php

namespace KanekiYuto\Handy\Cascade\Params;

use KanekiYuto\Handy\Cascade\Params\Migration as MigrationParams;

class Column
{

	private string $field;

	private string $comment;

	private array $migrationParams;

	private bool $hide;

	private string $cast;

	public function __construct(string $field)
	{
		$this->field = $field;
		$this->comment = '';
		$this->cast = '';
		$this->hide = false;
		$this->migrationParams = [];
	}

	public function isHide(): bool
	{
		return $this->hide;
	}

	public function setHide(bool $hide): static
	{
		$this->hide = $hide;

		return $this;
	}

	public function getField(): string
	{
		return $this->field;
	}

	public function getComment(): string
	{
		return $this->comment;
	}

	public function setComment(string $comment)
	{
		$this->comment = $comment;

		return $this;
	}

	public function getCast(): string
	{
		return $this->cast;
	}

	public function setCast(string $cast): static
	{
		$this->cast = $cast;

		return $this;
	}

	public function getMigrationParams(): array
	{
		return $this->migrationParams;
	}

	public function addMigrationParams(MigrationParams $migrationParams): static
	{
		$this->migrationParams[] = $migrationParams;

		return $this;
	}

}