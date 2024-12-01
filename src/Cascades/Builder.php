<?php

namespace KanekiYuto\Handy\Cascades;

use Closure;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascades\Constants\CascadeConst;
use KanekiYuto\Handy\Cascades\Make\EloquentTraceMake;
use KanekiYuto\Handy\Cascades\Make\MigrationMake;
use KanekiYuto\Handy\Cascades\Make\ModelMake;

/**
 * 构建 - [Builder]
 *
 * @author KanekiTuto
 */
class Builder
{

    /**
     * 创建实例
     *
     * @param string $table
     * @param Closure $callback
     * @param string $comment
     *
     * @return void
     */
    public static function create(
        string  $table,
        Closure $callback,
        string  $comment = ''
    ): void
    {
        $blueprint = new Blueprint($table, $comment);

        $callback($blueprint);

        // 引导构建
        (new EloquentTraceMake($blueprint))->boot();
        (new MigrationMake($blueprint))->boot();
        (new ModelMake($blueprint))->boot();
    }

    /**
     * 使用文件驱动
     *
     * @param string $root
     * @return Filesystem
     */
    public static function useDisk(string $root): Filesystem
    {
        return Storage::build([
            'driver' => 'local',
            'root' => $root,
        ]);
    }

    /**
     * 获取存根目录
     *
     * @return string
     */
    public static function getStubsPath(): string
    {
        return self::getPackagePath() . DIRECTORY_SEPARATOR . 'stubs';
    }

    /**
     * 获取包的根路径
     *
     * @return string
     */
    public static function getPackagePath(): string
    {
        return dirname(__DIR__, 2);
    }

    /**
     * 获取 [Migration] 文件夹地址
     *
     * @return string
     */
    public static function getMigrationPath(): string
    {
        $databasePath = database_path();

        return $databasePath . DIRECTORY_SEPARATOR . 'migrations';
    }

    /**
     * 获取应用路径
     *
     * @return string
     */
    public static function getAppPath(): string
    {
        $basePath = base_path();
        $basePath .= DIRECTORY_SEPARATOR;

        return $basePath . CascadeConst::APP_NAMESPACE_PATH;
    }

    /**
     * 命名空间转换文件路径
     *
     * @param string $namespace
     *
     * @return string
     */
    public static function namespaceCoverFilePath(string $namespace): string
    {
        return Str::of($namespace)
            ->replace('\\', DIRECTORY_SEPARATOR)
            ->toString();
    }

}
