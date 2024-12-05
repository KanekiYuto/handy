<?php

namespace KanekiYuto\Handy\Cascade1\Concerns;

use KanekiYuto\Handy\Trace\TraceEloquent;

trait HasTrace
{

	/**
	 * Trace class
	 *
	 * @var string<TraceEloquent>
	 */
	protected string $trace = TraceEloquent::class;

	/**
	 * Get trace
	 *
	 * @return string
	 */
	protected function getTrace(): string
	{
		return $this->trace;
	}

	/**
	 * Set Trace
	 *
	 * @param  string  $trace
	 *
	 * @return void
	 */
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

	/**
	 * Gel all attributes
	 */
	protected function getAllAttributes(): array
	{
		return $this->trace::getAllColumns();
	}

}