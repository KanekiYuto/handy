<?php

namespace KanekiYuto\Handy\Cascade\Make;

class ExtendsModelMake extends CascadeMake
{

    public function boot(): void
    {
        $this->run('Extends Model', 'model.extends.stub', function () {
            $configureParams = $this->configureParams;
            $getMakeParams = $configureParams->getExtendsModel();

            $className = $this->getDefaultClassName($getMakeParams->getClassSuffix());
            $namespace = $this->getConfigureNamespace([
                $getMakeParams->getNamespace(),
                $this->tableParams->getNamespace(),
            ]);

            $this->stubParam('namespace', $namespace);
            $this->stubParam('class', $className);
            $this->stubParam('extends', $this->modelParams->getExtends());

            $this->stub = $this->formattingStub($this->stub);

            $folderPath = $this->cascadeDiskPath([
                $getMakeParams->getFilepath(),
                $this->tableParams->getNamespace(),
            ]);

            $this->isPut($this->filename($className), $folderPath);
        });
    }

    /**
     * 获取引入的包完整名称
     *
     * @return string
     */
    public function getPackage(): string
    {
        $configureParams = $this->configureParams;
        $getMakeParams = $configureParams->getExtendsModel();

        return $this->getConfigureNamespace([
            $getMakeParams->getNamespace(),
            $this->tableParams->getNamespace(),
            $this->getDefaultClassName($getMakeParams->getClassSuffix()),
        ]);
    }

}