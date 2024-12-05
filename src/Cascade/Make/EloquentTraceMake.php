<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\Disk;
use KanekiYuto\Handy\Cascade\Params\Column as ColumnParams;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;

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
        note('开始创建 Eloquent Trace...');

        $stubsDisk = Disk::stubDisk();
        $this->load($stubsDisk->get('migration.stub'));

        if (empty($this->stub)) {
            error('创建失败...存根无效或不存在...');
            return;
        }

        $table = $this->blueprintParams->getTable();
        $className = $this->getDefaultClassName('Trace');

        $this->param('class', $className);
        $this->param('table', $table);

        $this->param('namespace', $this->getDefaultNamespace([
            'Trace',
            'Eloquent',
        ]));

        $this->param('primaryKey', 'self::ID');
        $this->param('columns', $this->makeColumns());

        $hidden = collect($this->hidden)->map(function (string $value) {
            return "self::$value";
        })->all();

        $this->param('hidden', implode(', ', $hidden));

        $fillable = collect($this->fillable)->map(function (string $value) {
            return "self::$value";
        })->all();

        $this->param('fillable', implode(', ', $fillable));

        echo $this->stub;
    }

    private function makeColumns(): string
    {
        $columns = $this->blueprintParams->getColumns();
        $templates = [];

        foreach ($columns as $column) {
            $templates[] = $this->makeColumn($column);
        }

        return $this->tab(implode("\n", $templates), 1);
    }

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

}