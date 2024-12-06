<?php

namespace KanekiYuto\Handy\Cascade\Make;

class ExtendsModelMake extends CascadeMake
{

    public function boot(): void
    {
        $this->run('Extends Model', 'model.extends.stub', function () {
            $className = $this->getDefaultClassName();

            $this->stubParam('namespace', $this->getNamespace());
            $this->stubParam('class', $className);
            $this->stubParam('extends', $this->modelParams->getExtends());

            $this->stub = $this->formattingStub($this->stub);

            $folderPath = $this->cascadeDiskPath([
                $this->tableParams->getNamespace(),
            ]);

            $this->isPut($this->filename($className), $folderPath);
        });
    }

    public function getNamespace(): string
    {
        return $this->getConfigureNamespace([
            $this->tableParams->getNamespace(),
        ]);
    }

    public function getNamespaceClass(): string
    {
        return $this->getConfigureNamespace([
            $this->tableParams->getNamespace(),
            $this->getDefaultClassName()
        ]);
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
        return parent::getDefaultClassName(empty($suffix) ? 'ExtendsModel' : $suffix);
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
            $this->configureParams->getExtendsModel()->getFilepath(),
            ...$values,
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
            $this->configureParams->getExtendsModel()->getNamespace(),
            ...$values,
        ]);
    }

}