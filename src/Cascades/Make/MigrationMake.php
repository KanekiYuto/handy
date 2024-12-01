<?php

namespace KanekiYuto\Handy\Cascades\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascades\Builder;
use KanekiYuto\Handy\Cascades\Constants\CascadeConst;
use KanekiYuto\Handy\Cascades\MigrationParams;
use stdClass;
use function Laravel\Prompts\error;
use function Laravel\Prompts\note;

/**
 * 构建 - [Migration]
 *
 * @author KanekiYuto
 */
class MigrationMake extends Make
{

    /**
     * 引导构建
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();

        note('开始创建 Migration...');

        $stubsDisk = Builder::useDisk(Builder::getStubsPath());
        $this->load($stubsDisk->get('migration.stub'));

        if (empty($this->stub)) {
            error('创建失败...存根无效或不存在...');
            return;
        }

        $blueprint = $this->blueprint;
        $table = $blueprint->getTable();

        // Do it...
        $this->param('traceEloquent', $this->getPackage($table, [
			CascadeConst::CASCADE_NAMESPACE,
            CascadeConst::TRACE_NAMESPACE,
            CascadeConst::TRACE_ELOQUENT_NAMESPACE
        ], CascadeConst::TRACE_NAMESPACE));

        $this->param('comment', $blueprint->getComment());
        $this->param('blueprint', $this->columns());

        $folderPath = Builder::getMigrationPath();
        $folderDisk = Builder::useDisk($folderPath);
        $fileName = $this->filename("cascade_create_{$table}_table.");

        $this->isPut($fileName, $folderPath, $folderDisk);
    }

    /**
     * 处理列数据
     *
     * @return string
     */
    private function columns(): string
    {
        $columns = $this->blueprint->getColumns();
        $templates = [];

        foreach ($columns as $column) {
            $columnParams = $column->getColumnParams();
            $migrationParams = $columnParams->getMigrationParams();

            $template = '@table';

            collect($migrationParams)->map(function (MigrationParams $migrationParam) use (&$template) {
                // 不使用的参数不输出
                if (!$migrationParam->isUse()) {
                    return $migrationParam;
                }

                $fn = $migrationParam->getFn();
                $params = $migrationParam->getParams();

                $paramsTemplate = "->$fn(";
                $paramsTemplate .= implode(', ', $this->parameters($params));

                $paramsTemplate .= ')';
                $template .= $paramsTemplate;

                return $migrationParam;
            });

            $template .= ';';
            $template = Str::of($template)->replace('@', '$');

            $templates[] = $template;
        }

        return $this->tab(implode("\n", $templates), 3);
    }

    /**
     * 处理列参数
     *
     * @param stdClass $values
     *
     * @return array
     */
    private function parameters(stdClass $values): array
    {
        $parameters = [];

        foreach ($values as $key => $val) {
            // 判断可以处理的类型 [其余类型可能不兼容]
            if (!in_array(gettype($val), ['string', 'boolean', 'double', 'integer', 'array'])) {
                continue;
            }

            $parameter = "$key: ";

            // 类型处理
            $val = match (gettype($val)) {
                'string' => "'$val'",
                'boolean' => $this->boolConvertString($val),
                'array' => $this->arrayParams($val),
                default => $val
            };

            // 指定的参数与列引用变量
            // @todo 可能存在隐患
            if ($key === 'column') {
                $field = Str::of($val)
                    ->replace("'", '')
                    ->upper();
                $val = "TheTrace::$field";
            }

            $parameter .= $val;
            $parameters[] = $parameter;
        }

        return $parameters;
    }

    /**
     * 数组转换为参数字符串
     *
     * @param array $values
     *
     * @return string
     */
    private function arrayParams(array $values): string
    {
        $val = json_encode($values, JSON_UNESCAPED_UNICODE);

        return Str::of($val)
            ->replace('"', '\'')
            ->replace(',', ', ')
            ->toString();
    }

}
