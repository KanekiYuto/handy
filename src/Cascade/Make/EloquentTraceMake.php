<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\Disk;
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
        $this->param('columns', $this->columns());

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

    /**
     * 处理列数据
     *
     * @return string
     */
    private function columns(): string
    {
        $columns = $this->blueprint->getColumns();
        $templates = [];

        foreach ($columns as $column) {
            $columnDefinition = $column->getColumnParams();
            $template = [];

            $field = $columnDefinition->getField();
            $constantCode = Str::of($field)->upper();

            $template[] = $this->templatePropertyComment($columnDefinition->getComment(), 'string');
            $template[] = $this->templateConst($constantCode, $field);
            $template = implode("", $template);

            // 判断该列是否标记为隐藏
            if ($columnDefinition->isHide()) {
                $this->hidden[] = $constantCode;
            } else {
                $this->fillable[] = $constantCode;
            }

            $templates[] = $template;
        }

        return $this->tab(implode("\n", $templates), 1);
    }

}