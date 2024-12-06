<?php

namespace KanekiYuto\Handy\Cascade\Params;

use KanekiYuto\Handy\Cascade\Params\Configure\Model;
use KanekiYuto\Handy\Cascade\Params\Configure\Migration;
use KanekiYuto\Handy\Cascade\Params\Configure\ExtendsModel;
use KanekiYuto\Handy\Cascade\Params\Configure\EloquentTrace;

class Configure
{

    private string $appNamespace;

    private string $appFilePath;

    private string $cascadeNamespace;

    private string $cascadeFilepath;

    private EloquentTrace $eloquentTrace;

    private Model $model;

    private ExtendsModel $extendsModel;

    private Migration $migration;

    public function __construct()
    {
        $this->appNamespace = 'App';
        $this->appFilePath = 'app';
        $this->cascadeNamespace = 'Cascade';
        $this->cascadeFilepath = $this->cascadeNamespace;
        $this->eloquentTrace = new EloquentTrace();
        $this->model = new Model();
        $this->extendsModel = new ExtendsModel();
        $this->migration = new Migration();
    }

    public function getAppNamespace(): string
    {
        return $this->appNamespace;
    }

    public function getAppFilepath(): string
    {
        return $this->appFilePath;
    }

    public function getCascadeNamespace(): string
    {
        return $this->cascadeNamespace;
    }

    public function getCascadeFilepath(): string
    {
        return $this->cascadeFilepath;
    }

    public function getEloquentTrace(): EloquentTrace
    {
        return $this->eloquentTrace;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getExtendsModel(): ExtendsModel
    {
        return $this->extendsModel;
    }

    public function getMigration(): Migration
    {
        return $this->migration;
    }

}