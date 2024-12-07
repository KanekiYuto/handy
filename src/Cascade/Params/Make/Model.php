<?php

namespace KanekiYuto\Handy\Cascade\Params\Make;

use KanekiYuto\Handy\Cascade\Make\ModelActivity;

class Model
{

    private string $extends;

    private ModelActivity $activity;

    private bool $incrementing;

    private bool $timestamps;

    public function __construct(string $extends, ModelActivity $activity, bool $incrementing, bool $timestamps)
    {
        $this->extends = $extends;
        $this->incrementing = $incrementing;
        $this->activity = $activity;
        $this->timestamps = $timestamps;
    }

    public function getExtends(): string
    {
        return $this->extends;
    }

    public function getActivity(): ModelActivity
    {
        return $this->activity;
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