<?php

namespace KanekiYuto\Handy\Cascade\Params;

class Model
{

	private string $extends;

	private bool $incrementing;

	private bool $timestamps;

	public function __construct(string $extends, bool $incrementing, bool $timestamps)
	{
		$this->extends = $extends;
		$this->incrementing = $incrementing;
		$this->timestamps = $timestamps;
	}

	public function getExtends(): string
	{
		return $this->extends;
	}

	public function getIncrementing(): bool
	{
		return $this->incrementing;
	}

	public function getTimestamps(): bool
	{
		return $this->timestamps;
	}
}