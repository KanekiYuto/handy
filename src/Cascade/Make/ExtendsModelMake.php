<?php

namespace KanekiYuto\Handy\Cascade\Make;

class ExtendsModelMake extends CascadeMake
{

    public function boot(): void
    {
        $this->run('Extends Model', 'model.extends.stub', function () {
            $className = $this->getDefaultClassName('ExtendsModel');
            $namespace = $this->getConfigureNamespace([
                $this->configureParams->getExtendsModel()->getNamespace(),
                $this->tableParams->getNamespace(),
            ]);

            $this->stubParam('namespace', $namespace);
            $this->stubParam('class', $className);
            $this->stubParam('extends', $this->modelParams->getExtends());

            $this->stub = $this->formattingStub($this->stub);

            $folderPath = $this->cascadeDiskPath([
                $this->configureParams->getExtendsModel()->getFilepath(),
                $this->tableParams->getNamespace(),
            ]);

            $this->isPut($this->filename($className), $folderPath);
        });
    }

    public function getNamespaceClass(): string
    {
        return $this->getConfigureNamespace([
            $this->configureParams->getExtendsModel()->getNamespace(),
            $this->tableParams->getNamespace(),
            $this->getDefaultClassName(),
        ]);
    }

}