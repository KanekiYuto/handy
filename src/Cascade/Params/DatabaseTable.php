<?php

namespace KanekiYuto\Handy\Cascade\Params;

class DatabaseTable
{

	private string $table;

	private string $comment;

	public function __construct(string $table, string $comment)
	{
		$this->table = $table;
		$this->comment = $comment;
	}

	public function getTable(): string
	{
		return $this->table;
	}

	public function getComment(): string
	{
		return $this->comment;
	}

}