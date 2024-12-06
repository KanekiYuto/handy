<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Contracts\Filesystem\Filesystem;

class ModelMake extends CascadeMake
{

    private array $casts = [];

    private array $packages = [];

    public function boot(): void
    {
        $this->run('Model', 'model.base.stub', function () {
            $className = $this->getClassName();
            $namespace = $this->getConfigureNamespace([
                $this->tableParams->getNamespace(),
            ]);

            $this->stubParam('namespace', $namespace);
            $this->stubParam('class', $className);
            $this->stubParam('comment', '');

            $this->stubParam('traceEloquent', $this->getTraceEloquentNamespace());
            $this->stubParam('timestamps', $this->modelParams->getTimestamps());
            $this->stubParam('incrementing', $this->modelParams->getIncrementing());
            $this->stubParam('extends', $this->modelParams->getExtends());

            $this->stubParam('casts', $this->makeCasts());
            $this->stubParam('usePackages', $this->makeUsePackages());

            $this->stub = $this->formattingStub($this->stub);

            $this->cascadeDisk([
                $this->tableParams->getNamespace(),
            ])->put($this->filename($className), $this->stub);
        });
    }

    public function getClassName(): string
    {
        return $this->getDefaultClassName('Model');
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

    public function getTraceEloquentNamespace(): string
    {
        $make = $this->getTraceEloquent();

        return $make->getConfigureNamespace([
            $this->tableParams->getNamespace(),
            $make->getDefaultClassName(),
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
     * 获取 [Cascade] 磁盘
     *
     * @param  array  $values
     *
     * @return Filesystem
     */
    protected function cascadeDisk(array $values): Filesystem
    {
        return parent::cascadeDisk([
            $this->configureParams->getModel()->getFilepath(),
            ...$values,
        ]);
    }

}