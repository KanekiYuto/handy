<?php

namespace KanekiYuto\Handy\Cascade\Params\Make;

use Illuminate\Support\Str;

class Table
{

    private string $table;

    private string $comment;

    private string $namespace;

    public function __construct(string $table, string $comment)
    {
        $this->table = $table;
        $this->comment = $comment;
        $this->namespace = $this->setNamespace();
    }

    private function setNamespace(): string
    {
        $table = explode('_', $this->table);
        $table = collect($table)->except([count($table) - 1])->all();
        $table = implode('_', $table);

        return Str::of(Str::headline($table))
            ->replace(' ', '')
            ->toString();
    }

    public function getNamespace(): string
    {
        return $this->namespace;
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