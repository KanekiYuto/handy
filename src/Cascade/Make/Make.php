<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\Params\Make\Model as ModelParams;
use KanekiYuto\Handy\Cascade\Params\Make\Table as TableParams;
use KanekiYuto\Handy\Cascade\Params\Blueprint as BlueprintParams;
use KanekiYuto\Handy\Cascade\Params\Make\Migration as MigrationParams;

class Make
{

    use Template;

    protected string $stub;

    protected TableParams $tableParams;

    protected MigrationParams $migrationParams;

    protected ModelParams $modelParams;

    protected BlueprintParams $blueprintParams;

    /**
     * construct
     *
     * @param  BlueprintParams  $blueprintParams
     * @param  TableParams      $tableParams
     * @param  ModelParams      $modelParams
     * @param  MigrationParams  $migrationParams
     */
    public function __construct(
        BlueprintParams $blueprintParams,
        TableParams $tableParams,
        ModelParams $modelParams,
        MigrationParams $migrationParams
    ) {
        $this->blueprintParams = $blueprintParams;
        $this->migrationParams = $migrationParams;
        $this->tableParams = $tableParams;
        $this->modelParams = $modelParams;
    }

    /**
     * 获取一个默认的类名称 (根据表名称生成)
     *
     * @param  string  $suffix
     *
     * @return string
     */
    public function getDefaultClassName(string $suffix = ''): string
    {
        $table = $this->tableParams->getTable();

        $className = explode('_', $table);

        // 取最后一个名称作为最终的类名
        $className = collect($className)->last();
        $className = Str::headline($className);

        return $className . $suffix;
    }

    /**
     * load param to the stub
     *
     * @param  string       $param
     * @param  string|bool  $value
     * @param  bool         $load
     * @param  string|null  $stub
     *
     * @return string
     */
    public function param(string $param, string|bool $value, bool $load = true, string $stub = null): string
    {
        $value = match (gettype($value)) {
            'boolean' => $this->boolConvertString($value),
            default => $value
        };

        $replaceStub = $this->replace("{{ $param }}", $value, $stub);

        if ($load) {
            $this->load($replaceStub);
        }

        return $replaceStub;
    }

    /**
     * 布尔值转换成字符串
     *
     * @param  bool  $bool
     *
     * @return string
     */
    protected final function boolConvertString(bool $bool): string
    {
        return $bool ? 'true' : 'false';
    }

    /**
     * 字符串替换
     *
     * @param  string       $search
     * @param  string       $replace
     * @param  string|null  $stub
     *
     * @return string
     */
    protected final function replace(string $search, string $replace, string $stub = null): string
    {
        if (empty($stub)) {
            $stub = $this->stub;
        }

        return Str::of($stub)
            ->replace($search, $replace)
            ->toString();
    }

    /**
     * load stub
     *
     * @param  string|null  $stub
     *
     * @return void
     */
    protected final function load(string|null $stub): void
    {
        if (!empty($stub)) {
            $this->stub = $stub;
        }
    }

    protected final function getDefaultNamespace(array $prefix, string $className): string
    {
        $table = $this->tableParams->getTable();

        $table = explode('_', $table);
        $table = collect($table)
            ->except([count($table) - 1])
            ->all();

        $table = implode('\\', $table);
        $table = Str::headline($table);

        return implode('\\', [
            'App\\Cascade',
            ...$prefix,
            $table,
            $className,
        ]);
    }

    /**
     * get the filename
     *
     * @param  string  $filename
     * @param  string  $suffix
     *
     * @return string
     */
    protected final function filename(string $filename, string $suffix = 'php'): string
    {
        return "$filename.$suffix";
    }

}