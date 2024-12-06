<?php

namespace KanekiYuto\Handy\Cascade\Params\Configure;

use Illuminate\Support\Str;

class ExtendsModel
{

    private string $namespace;

    private string $filepath;

    public function __construct()
    {
        $this->namespace = 'ExtendsModels';
        $this->filepath = Str::of($this->namespace)
            ->replace('\\', DIRECTORY_SEPARATOR)
            ->toString();
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getFilepath(): string
    {
        return $this->filepath;
    }

}