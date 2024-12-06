<?php

namespace KanekiYuto\Handy\Cascade\Concerns;

use KanekiYuto\Handy\Trace\TraceEloquent;

trait HasTrace
{

	protected string $trace = TraceEloquent::class;

	protected function getTrace(): string
	{
		return $this->trace;
	}

	protected function setTrace(string $trace): void
	{
		$this->trace = $trace;
	}

	protected function getTable()
	{
		return $this->trace::TABLE;
	}

	protected function getHidden()
	{
		return $this->trace::HIDDEN;
	}

	protected function getFillable()
	{
		return $this->trace::FILLABLE;
	}

	protected function getAllAttributes(): array
	{
		return $this->trace::getAllColumns();
	}

}