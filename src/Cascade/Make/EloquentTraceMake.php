<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use Illuminate\Contracts\Filesystem\Filesystem;
use KanekiYuto\Handy\Cascade\Params\Column as ColumnParams;

class EloquentTraceMake extends Make
{

    /**
     * property
     *
     * @var array
     */
    private array $hidden = [];

    /**
     * property
     *
     * @var array
     */
    private array $fillable = [];

    /**
     * 引导构建
     *
     * @return void
     */
    public function boot(): void
    {
        $this->run('Eloquent Trace', 'eloquent-trace.stub', function () {
            $table = $this->blueprintParams->getTable();
            $className = $this->getClassName();

            $this->param('class', $className);
            $this->param('table', $table);

            $this->param('namespace', $this->getConfigureNamespace([
                $this->getNamespace(),
            ]));

            $this->param('primaryKey', 'self::ID');
            $this->param('columns', $this->makeColumns());
            $this->param('hidden', $this->makeHidden());
            $this->param('fillable', $this->makeFillable());

            $this->cascadeDisk([
                $this->getNamespace(),
            ])->put($this->filename($className), $this->stub);
        });
    }

    public function getConfigureNamespace(array $values): string
    {
        return parent::getConfigureNamespace([
            $this->configureParams->getEloquentTrace()->getNamespace(),
            ...$values,
        ]);
    }

    /**
     * 构建所有列信息
     *
     * @return string
     */
    private function makeColumns(): string
    {
        $columns = $this->blueprintParams->getColumns();
        $templates = [];

        foreach ($columns as $column) {
            $templates[] = $this->makeColumn($column);
        }

        return $this->tab(implode("\n", $templates), 1);
    }

    /**
     * 构建列参数
     *
     * @param  ColumnParams  $column
     *
     * @return string
     */
    private function makeColumn(ColumnParams $column): string
    {
        $template = [];

        $field = $column->getField();
        $constantName = Str::of($field)->upper()->toString();

        $template[] = $this->templatePropertyComment($column->getComment(), 'string');
        $template[] = $this->templateConst($constantName, $field);
        $template = implode('', $template);

        if ($column->isHide()) {
            $this->hidden[] = $constantName;
        } else {
            $this->fillable[] = $constantName;
        }

        return $template;
    }

    public function makeHidden(): string
    {
        $hidden = collect($this->hidden)->map(function (string $value) {
            return "self::$value";
        })->all();

        return implode(', ', $hidden);
    }

    public function makeFillable(): string
    {
        $fillable = collect($this->fillable)->map(function (string $value) {
            return "self::$value";
        })->all();

        return implode(', ', $fillable);
    }

    protected function cascadeDisk(array $values): Filesystem
    {
        return parent::cascadeDisk([
            $this->configureParams->getEloquentTrace()->getFilepath(),
            ...$values,
        ]);
    }

    public function getClassName(): string
    {
        return $this->getDefaultClassName('Trace');
    }

}