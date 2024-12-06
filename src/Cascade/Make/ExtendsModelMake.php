<?php

namespace KanekiYuto\Handy\Cascade\Make;

class ExtendsModelMake extends CascadeMake
{

    public function boot(): void
    {
        $this->run('Extends Model', 'model.extends.stub', function () {
            $configureParams = $this->configureParams;
            $getExtendsModel = $configureParams->getExtendsModel();

            $className = $this->getDefaultClassName($getExtendsModel->getClassSuffix());
            $namespace = $this->getConfigureNamespace([
                $getExtendsModel->getNamespace(),
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
        $configureParams = $this->configureParams;
        $getExtendsModel = $configureParams->getExtendsModel();

        return $this->getConfigureNamespace([
            $getExtendsModel->getNamespace(),
            $this->tableParams->getNamespace(),
            $this->getDefaultClassName($getExtendsModel->getClassSuffix()),
        ]);
    }

}