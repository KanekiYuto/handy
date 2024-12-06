<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\Params\Column as ColumnParams;

/**
 * EloquentTrace
 *
 * @author KanekiYuto
 */
class EloquentTraceMake extends CascadeMake
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
            $className = $this->getDefaultClassName();

            $this->stubParam('namespace', $this->getNamespace());
            $this->stubParam('class', $className);
            $this->stubParam('table', $table);

            $this->stubParam('primaryKey', 'self::ID');
            $this->stubParam('columns', $this->makeColumns());
            $this->stubParam('hidden', $this->makeConstantValues($this->hidden));
            $this->stubParam('fillable', $this->makeConstantValues($this->fillable));

            $folderPath = $this->cascadeDiskPath([
                $this->tableParams->getNamespace(),
            ]);

            $this->isPut($this->filename($className), $folderPath);
        });
    }

    /**
     * 获取默认的类名称
     *
     * @param  string  $suffix
     *
     * @return string
     */
    public function getDefaultClassName(string $suffix = ''): string
    {
        return parent::getDefaultClassName(empty($suffix) ? 'Trace' : $suffix);
    }

    /**
     * 获取设置的命名空间
     *
     * @param  array  $values
     *
     * @return string
     */
    public function getConfigureNamespace(array $values): string
    {
        return parent::getConfigureNamespace([
            $this->configureParams->getEloquentTrace()->getNamespace(),
            ...$values,
        ]);
    }

    public function getNamespace(): string
    {
        return $this->getConfigureNamespace([
            $this->tableParams->getNamespace(),
        ]);
    }

    public function getNamespaceClass(): string
    {
        return $this->getConfigureNamespace([
            $this->tableParams->getNamespace(),
            $this->getDefaultClassName()
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

    /**
     * 构建常量值
     *
     * @param  array  $values
     *
     * @return string
     */
    private function makeConstantValues(array $values): string
    {
        $values = collect($values)->map(function (string $value) {
            return "self::$value";
        })->all();

        return implode(', ', $values);
    }

    /**
     * 获取 [Cascade] 磁盘路径
     *
     * @param  array  $values
     *
     * @return string
     */
    protected function cascadeDiskPath(array $values): string
    {
        return parent::cascadeDiskPath([
            $this->configureParams->getEloquentTrace()->getFilepath(),
            ...$values,
        ]);
    }

}