<?php

namespace KanekiYuto\Handy\Cascades\Make;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use KanekiYuto\Handy\Cascades\Blueprint;
use KanekiYuto\Handy\Cascades\Builder;
use KanekiYuto\Handy\Cascades\Constants\CascadeConst;
use KanekiYuto\Handy\Cascades\Contracts\Make as MakeInterface;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\warning;

/**
 * Make abstract
 *
 * @author KanekiYuto
 */
abstract class Make implements MakeInterface
{

    use Template;

    /**
     * property
     *
     * @var Blueprint
     */
    protected readonly Blueprint $blueprint;

    /**
     * property
     *
     * @var string
     */
    protected string $stub;

    /**
     * construct
     *
     * @param Blueprint $blueprint
     *
     * @return void
     */
    public function __construct(Blueprint $blueprint)
    {
        $this->blueprint = $blueprint;
    }

    /**
     * boot make
     *
     * @return void
     */
    public function boot(): void
    {
        // Do it...
    }

    /**
     * load param to the stub
     *
     * @param string $param
     * @param string|bool $value
     * @param bool $load
     * @param string|null $stub
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
     * bool convert string
     *
     * @param bool $bool
     *
     * @return string
     */
    protected final function boolConvertString(bool $bool): string
    {
        return $bool ? 'true' : 'false';
    }

    /**
     * string replace
     *
     * @param string $search
     * @param string $replace
     * @param string|null $stub
     *
     * @return Stringable
     */
    protected final function replace(string $search, string $replace, string $stub = null): Stringable
    {
        if (empty($stub)) {
            $stub = $this->stub;
        }

        return Str::of($stub)->replace($search, $replace);
    }

    /**
     * load stub
     *
     * @param string|null $stub
     *
     * @return void
     */
    protected final function load(string|null $stub): void
    {
        if (!empty($stub)) {
            $this->stub = $stub;
        }
    }

    /**
     * get the package name
     *
     * @param string $table
     * @param array $namespace
     * @param string $suffix
     *
     * @return string
     */
    protected final function getPackage(string $table, array $namespace, string $suffix = ''): string
    {
        return implode(CascadeConst::NAMESPACE_SEPARATOR, [
            CascadeConst::APP_NAMESPACE,
            $this->getNamespace($table, $namespace),
            $this->getClassName($table, $suffix)
        ]);
    }

    /**
     * get the namespace
     *
     * @param string $table
     * @param array $namespace
     *
     * @return string
     */
    protected final function getNamespace(string $table, array $namespace): string
    {
        $namespace = implode(CascadeConst::NAMESPACE_SEPARATOR, $namespace);

        $className = Str::headline($table);
        $className = explode(' ', $className);
        $className = collect($className);

        $className->pop();
        $className = $className->all();

        if (empty($className)) {
            return '';
        }

        $className = implode(CascadeConst::NAMESPACE_SEPARATOR, $className);

        return $namespace . CascadeConst::NAMESPACE_SEPARATOR . $className;
    }

    /**
     * get the class name
     *
     * @param string $table
     * @param string $suffix
     *
     * @return string
     */
    protected final function getClassName(string $table, string $suffix = ''): string
    {
        $className = explode('_', $table);

        if (empty($className)) {
            return '';
        }

        $className = collect($className)->last();
        $className = Str::headline($className);

        return $className . $suffix;
    }

    /**
     * put stub to file
     *
     * @param string $namespace
     * @param string $className
     *
     * @return void
     */
    protected final function putFile(string $namespace, string $className): void
    {
        $folderPath = implode(DIRECTORY_SEPARATOR, [
            Builder::getAppPath(),
            Builder::namespaceCoverFilePath($namespace)
        ]);

        $folderDisk = Builder::useDisk($folderPath);
        $fileName = $this->filename($className);

        $this->isPut($fileName, $folderPath, $folderDisk);
    }

    /**
     * get the filename
     *
     * @param string $filename
     * @param string $suffix
     *
     * @return string
     */
    protected final function filename(string $filename, string $suffix = 'php'): string
    {
        return "$filename.$suffix";
    }

    /**
     * is put
     *
     * @param string $fileName
     * @param string $folderPath
     * @param Filesystem $folderDisk
     *
     * @return void
     */
    public function isPut(string $fileName, string $folderPath, Filesystem $folderDisk): void
    {
        $isPut = $this->put($fileName, $folderDisk);

        if (!$isPut) {
            error('创建失败...写入文件失败！');
            return;
        }

        info('创建...完成！');
        warning("文件路径: [$folderPath/$fileName]");
    }

    /**
     * put the stub
     *
     * @param string $filename
     * @param Filesystem $disk
     *
     * @return bool
     */
    protected final function put(string $filename, Filesystem $disk): bool
    {
        return $disk->put($filename, $this->stub);
    }

}
