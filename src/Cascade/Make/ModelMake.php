<?php

namespace KanekiYuto\Handy\Cascade\Make;

use KanekiYuto\Handy\Cascade\DiskManager;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;

class ModelMake extends Make
{

    public function boot()
    {
        note('开始创建 Model...');

        $stubsDisk = DiskManager::stubDisk();
        $this->load($stubsDisk->get('model.base.stub'));

        if (empty($this->stub)) {
            error('创建失败...存根无效或不存在...');
            return;
        }


    }

}