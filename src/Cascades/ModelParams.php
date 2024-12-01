<?php

namespace KanekiYuto\Handy\Cascades;

class ModelParams
{

	/**
	 *
	 * @var string
	 */
	private string $extends;


	/**
	 *
	 * @var bool
	 */
	private bool $incrementing;

	/**
	 *
	 * @var bool
	 */
	private bool $timestamps;

	/**
	 * @return string
	 */
	public function getExtends(): string
	{
		return $this->extends;
	}

	/**
	 * @param  string  $extends
	 *
	 * @return ModelParams
	 */
	public function setExtends(string $extends): static
	{
		$this->extends = $extends;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isIncrementing(): bool
	{
		return $this->incrementing;
	}

	/**
	 * @param  bool  $incrementing
	 *
	 * @return ModelParams
	 */
	public function setIncrementing(bool $incrementing): static
	{
		$this->incrementing = $incrementing;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isTimestamps(): bool
	{
		return $this->timestamps;
	}

	/**
	 * @param  bool  $timestamps
	 *
	 * @return ModelParams
	 */
	public function setTimestamps(bool $timestamps): static
	{
		$this->timestamps = $timestamps;

		return $this;
	}

}