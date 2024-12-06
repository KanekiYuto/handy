<?php

namespace KanekiYuto\Handy\Cascade\Params\Configure;

use Illuminate\Support\Str;

class ExtendsModel
{

    private string $namespace;

    private string $filepath;

    private string $classSuffix;

    public function __construct()
    {
        $this->namespace = 'ExtendsModels';
        $this->filepath = Str::of($this->namespace)
            ->replace('\\', DIRECTORY_SEPARATOR)
            ->toString();
        $this->classSuffix = 'ExtendsModel';
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getFilepath(): string
    {
        return $this->filepath;
    }

    public function getClassSuffix(): string
    {
        return $this->classSuffix;
    }

}