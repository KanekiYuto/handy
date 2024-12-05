<?php

namespace KanekiYuto\Handy\Cascade\Make;

use KanekiYuto\Handy\Cascade\Disk;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;

class EloquentTraceMake extends Make
{

    /**
     * property
     *
     * @var array
     */
    private array $hidden = [];

    /**
     * property
     *
     * @var array
     */
    private array $fillable = [];

    /**
     * 引导构建
     *
     * @return void
     */
    public function boot(): void
    {
        note('开始创建 Eloquent Trace...');

        $stubsDisk = Disk::stubDisk();
        $this->load($stubsDisk->get('migration.stub'));

        if (empty($this->stub)) {
            error('创建失败...存根无效或不存在...');
            return;
        }

        $table = $this->blueprintParams->getTable();
        $className = $this->getDefaultClassName('Trace');

        $this->param('class', $this->makeClassName());
    }

    public function makeClassName(): string
    {
        return $this->getDefaultClassName('Trace');
    }

}