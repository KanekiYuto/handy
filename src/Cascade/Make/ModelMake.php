<?php

namespace KanekiYuto\Handy\Cascade\Make;

class ModelMake extends CascadeMake
{

    private array $casts = [];

    private array $packages = [];

    public function boot(): void
    {
        $this->run('Model', 'model.base.stub', function () {
            $className = $this->getDefaultClassName();

            $this->stubParam('namespace', $this->getNamespace());
            $this->stubParam('class', $className);
            $this->stubParam('comment', '');

            $this->stubParam(
                'traceEloquent',
                $this->getTraceEloquentMake()->getNamespaceClass()
            );

            $this->stubParam('timestamps', $this->modelParams->getTimestamps());
            $this->stubParam('incrementing', $this->modelParams->getIncrementing());

            $this->stubParam(
                'extends',
                $this->getTraceEloquentMake()->getNamespaceClass()
            );

            $this->stubParam('casts', $this->makeCasts());
            $this->stubParam('usePackages', $this->makeUsePackages());

            $this->stub = $this->formattingStub($this->stub);

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
        return parent::getDefaultClassName(empty($suffix) ? 'Model' : $suffix);
    }

    public function getNamespace(): string
    {
        return $this->getConfigureNamespace([
            $this->tableParams->getNamespace(),
        ]);
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
            $this->configureParams->getModel()->getNamespace(),
            ...$values,
        ]);
    }

    private function makeCasts(): string
    {
        if (empty($this->casts)) {
            return 'return array_merge(parent::casts(), []);';
        }

        $templates[] = 'return array_merge(parent::casts(), [';

        $casts = collect($this->casts)->map(function (string $value, string $key) {

            if (class_exists($value)) {
                $namespace = explode('\\', $value);
                $className = $namespace[count($namespace) - 1];
                $value = "$className::class";
                $this->addPackage(implode('\\', $namespace));
            } else {
                $value = "'$value'";
            }

            return "\t$key => $value,";
        })->all();

        $templates = array_merge($templates, $casts);
        $templates[] = ']);';

        return implode("\n\t\t", $templates);
    }

    private function addPackage(string $value): void
    {
        if (!in_array($value, $this->packages)) {
            $this->packages[] = $value;
        }
    }

    private function makeUsePackages(): string
    {
        $packages = collect($this->packages)->map(function (string $value) {
            return "use $value;";
        })->all();

        return implode("\n", $packages);
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
            $this->configureParams->getModel()->getFilepath(),
            ...$values,
        ]);
    }

}