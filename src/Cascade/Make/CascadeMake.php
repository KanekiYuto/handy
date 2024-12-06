<?php

namespace KanekiYuto\Handy\Cascade\Make;

use KanekiYuto\Handy\Cascade\DiskManager;
use Illuminate\Contracts\Filesystem\Filesystem;

abstract class CascadeMake extends Make
{

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

}