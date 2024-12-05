<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Contracts\Filesystem\Filesystem;

class ModelMake extends Make
{

    private array $casts = [];

    private array $packages = [];

    public function boot(): void
    {
        $this->run('Model', 'model.base.stub', function () {
            $className = $this->getClassName();

            $this->param('namespace', $this->getConfigureNamespace([
                $this->getNamespace(),
            ]));

            $this->param('class', $className);
            $this->param('comment', '');

            $this->param('traceEloquent', $this->getTraceEloquentNamespace());
            $this->param('timestamps', $this->modelParams->getTimestamps());
            $this->param('incrementing', $this->modelParams->getIncrementing());
            $this->param('extends', $this->modelParams->getExtends());

            $this->param('casts', $this->makeCasts());
            $this->param('usePackages', $this->makeUsePackages());

            $this->stub = $this->formattingStub($this->stub);

            $this->cascadeDisk([
                $this->getNamespace(),
            ])->put($this->filename($className), $this->stub);
        });
    }

    public function getClassName(): string
    {
        return $this->getDefaultClassName('Model');
    }

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
            $make->getNamespace(),
            $make->getClassName(),
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

    protected function cascadeDisk(array $values): Filesystem
    {
        return parent::cascadeDisk([
            $this->configureParams->getModel()->getFilepath(),
            ...$values,
        ]);
    }

}