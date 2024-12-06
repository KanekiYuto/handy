<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Closure;
use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\DiskManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use KanekiYuto\Handy\Cascade\Params\Make\Model as ModelParams;
use KanekiYuto\Handy\Cascade\Params\Make\Table as TableParams;
use KanekiYuto\Handy\Cascade\Params\Configure as ConfigureParams;
use KanekiYuto\Handy\Cascade\Params\Blueprint as BlueprintParams;
use KanekiYuto\Handy\Cascade\Params\Make\Migration as MigrationParams;
use KanekiYuto\Handy\Cascade\Contract\Make as MakeContract;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;

/**
 * Make
 *
 * @author KanekiYuto
 */
abstract class Make implements MakeContract
{

    use Template, Helper;

    /**
     * property
     *
     * @var string
     */
    protected string $stub;

    /**
     * property
     *
     * @var ConfigureParams
     */
    protected ConfigureParams $configureParams;

    /**
     * property
     *
     * @var TableParams
     */
    protected TableParams $tableParams;

    /**
     * property
     *
     * @var MigrationParams
     */
    protected MigrationParams $migrationParams;

    /**
     * property
     *
     * @var ModelParams
     */
    protected ModelParams $modelParams;

    /**
     * property
     *
     * @var BlueprintParams
     */
    protected BlueprintParams $blueprintParams;

    /**
     * construct
     *
     * @param  ConfigureParams  $configureParams
     * @param  BlueprintParams  $blueprintParams
     * @param  TableParams      $tableParams
     * @param  ModelParams      $modelParams
     * @param  MigrationParams  $migrationParams
     */
    public function __construct(
        ConfigureParams $configureParams,
        BlueprintParams $blueprintParams,
        TableParams $tableParams,
        ModelParams $modelParams,
        MigrationParams $migrationParams
    ) {
        $this->configureParams = $configureParams;
        $this->blueprintParams = $blueprintParams;
        $this->migrationParams = $migrationParams;
        $this->tableParams = $tableParams;
        $this->modelParams = $modelParams;
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
        return implode('\\', [
            $this->configureParams->getAppNamespace(),
            $this->configureParams->getCascadeNamespace(),
            ...$values,
        ]);
    }

    /**
     * 获取一个默认的类名称 (根据表名称生成)
     *
     * @param  string  $suffix
     *
     * @return string
     */
    protected function getDefaultClassName(string $suffix = ''): string
    {
        $table = $this->tableParams->getTable();

        $className = explode('_', $table);

        // 取最后一个名称作为最终的类名
        $className = collect($className)->last();
        $className = Str::headline($className);

        return $className . $suffix;
    }

    /**
     * 运行构建
     *
     * @param  string   $name
     * @param  string   $stub
     * @param  Closure  $callable
     *
     * @return void
     */
    protected function run(string $name, string $stub, Closure $callable): void
    {
        note("开始构建 $name...");

        $stubsDisk = DiskManager::stubDisk();
        $this->load($stubsDisk->get($stub));

        if (empty($this->stub)) {
            error('创建失败...存根无效或不存在...');
            return;
        }

        $callable();
    }

    /**
     * 获取 [Cascade] 磁盘
     *
     * @param  array  $values
     *
     * @return Filesystem
     */
    protected function cascadeDisk(array $values): Filesystem
    {
        return DiskManager::useDisk(implode(DIRECTORY_SEPARATOR, [
            $this->configureParams->getAppFilepath(),
            $this->configureParams->getCascadeFilepath(),
            ...$values,
        ]));
    }

    protected function getTraceEloquent(): EloquentTraceMake
    {
        return new EloquentTraceMake(
            $this->configureParams,
            $this->blueprintParams,
            $this->tableParams,
            $this->modelParams,
            $this->migrationParams
        );
    }

}