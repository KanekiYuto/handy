<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\Builder;
use KanekiYuto\Handy\Cascade\Constants\CascadeConst;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;

/**
 * 构建 - [EloquentTrace]
 *
 * @author KanekiYuto
 */
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
		parent::boot();

		note('开始创建 Eloquent Trace...');

		$stubsDisk = Builder::useDisk(Builder::getStubsPath());
		$this->load($stubsDisk->get('eloquent-trace.stub'));

		if (empty($this->stub)) {
			error('创建失败...存根无效或不存在...');
			return;
		}

		$blueprint = $this->blueprint;
		$table = $blueprint->getTable();
		$className = $this->getClassName($table, CascadeConst::TRACE_FILE_SUFFIX);
		$namespace = $this->getNamespace($table, [
			CascadeConst::CASCADE_NAMESPACE,
			CascadeConst::TRACE_NAMESPACE,
			CascadeConst::TRACE_ELOQUENT_NAMESPACE,
		]);

		// Do it...
		$this->param('namespace', implode(CascadeConst::NAMESPACE_SEPARATOR, [
			CascadeConst::APP_NAMESPACE,
			$namespace,
		]));

		$this->param('table', $blueprint->getTable());
		$this->param('class', $className);

		// @todo 智能可选
		$this->param('primaryKey', 'self::ID');
		$this->param('columns', $this->columns());

		$hidden = collect($this->hidden)->map(function (string $value) {
			return "self::$value";
		})->all();

		$this->param('hidden', implode(', ', $hidden));

		$fillable = collect($this->fillable)->map(function (string $value) {
			return "self::$value";
		})->all();

		$this->param('fillable', implode(', ', $fillable));

		$this->putFile($namespace, $className);
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
			$columnDefinition = $column->getColumnParams();
			$template = [];

			$field = $columnDefinition->getField();
			$constantCode = Str::of($field)->upper();

			$template[] = $this->templatePropertyComment($columnDefinition->getComment(), 'string');
			$template[] = $this->templateConst($constantCode, $field);
			$template = implode("", $template);

			// 判断该列是否标记为隐藏
			if ($columnDefinition->isHide()) {
				$this->hidden[] = $constantCode;
			} else {
				$this->fillable[] = $constantCode;
			}

			$templates[] = $template;
		}

		return $this->tab(implode("\n", $templates), 1);
	}

}
