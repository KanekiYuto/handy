<?php

namespace KanekiYuto\Handy\Cascade\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade\Builder;
use KanekiYuto\Handy\Cascade\Blueprint;
use KanekiYuto\Handy\Cascade\ModelParams;
use KanekiYuto\Handy\Cascade\Constants\CascadeConst;
use function Laravel\Prompts\note;
use function Laravel\Prompts\error;

/**
 * 构建 - [Model]
 *
 * @author KanekiYuto
 */
class ModelMake extends Make
{

	private array $casts = [];

	private array $packages = [];

	private ModelParams $modelParams;

	/**
	 * construct
	 *
	 * @param  Blueprint    $blueprint
	 * @param  ModelParams  $modelParams
	 *
	 * @return void
	 */
	public function __construct(Blueprint $blueprint, ModelParams $modelParams)
	{
		$this->modelParams = $modelParams;
		parent::__construct($blueprint);
	}

	/**
	 * 引导构建
	 *
	 * @return void
	 */
	public function boot(): void
	{
		parent::boot();

		note('开始创建 Model...');

		$stubsDisk = Builder::useDisk(Builder::getStubsPath());
		$this->load($stubsDisk->get('model.base.stub'));

		if (empty($this->stub)) {
			error('创建失败...存根无效或不存在...');
			return;
		}

		$blueprint = $this->blueprint;
		$modelParams = $this->modelParams;

		$table = $blueprint->getTable();
		$className = $this->getClassName($table, CascadeConst::MODEL_FILE_SUFFIX);
		$namespace = $this->getNamespace($table, [
			CascadeConst::CASCADE_NAMESPACE,
			CascadeConst::MODEL_NAMESPACE,
		]);

		// Do it...
		$this->param('namespace', implode(CascadeConst::NAMESPACE_SEPARATOR, [
			CascadeConst::APP_NAMESPACE,
			$namespace,
		]));

		$this->param('class', $className);
		$this->param('comment', $blueprint->getComment());

		$this->param('traceEloquent', $this->getPackage($table, [
			CascadeConst::CASCADE_NAMESPACE,
			CascadeConst::TRACE_NAMESPACE,
			CascadeConst::TRACE_ELOQUENT_NAMESPACE,
		], CascadeConst::TRACE_NAMESPACE));

		$this->param('table', $table);

		$this->param('timestamps', $modelParams->isTimestamps());
		$this->param('incrementing', $modelParams->isIncrementing());
		$this->param('extends', $modelParams->getExtends());

		$this->columns();
		$this->param('casts', $this->casts());
		$this->param('usePackages', $this->usePackages());

		$this->stub = $this->formattingStub($this->stub);
		$this->putFile($namespace, $className);
	}

	private function columns(): void
	{
		$columns = $this->blueprint->getColumns();

		foreach ($columns as $column) {
			$columnDefinition = $column->getColumnParams();
			$cast = $columnDefinition->getCast();

			$field = $columnDefinition->getField();
			$constantCode = Str::of($field)->upper()->toString();

			if (!empty($cast)) {
				$this->casts["TheTrace::$constantCode"] = $cast;
			}
		}
	}

	/**
	 * 处理强制转换的属性
	 *
	 * @return string
	 */
	private function casts(): string
	{
		if (empty($this->casts)) {
			return 'return array_merge(parent::casts(), []);';
		}

		$templates[] = 'return array_merge(parent::casts(), [';

		$casts = collect($this->casts)->map(function (string $value, string $key) {
			if (class_exists($value)) {
				$namespace = explode(CascadeConst::NAMESPACE_SEPARATOR, $value);
				$className = $namespace[count($namespace) - 1];
				$value = "$className::class";
				$this->addPackage(implode(CascadeConst::NAMESPACE_SEPARATOR, $namespace));
			} else {
				$value = "'$value'";
			}

			return "\t$key => $value,";
		})->all();

		$templates = array_merge($templates, $casts);
		$templates[] = ']);';

		return implode("\n\t\t", $templates);
	}

	private function addPackage(string $value): void
	{
		if (!in_array($value, $this->packages)) {
			$this->packages[] = $value;
		}
	}

	private function usePackages(): string
	{
		$packages = collect($this->packages)->map(function (string $value) {
			return "use $value;";
		})->all();

		return implode("\n", $packages);
	}

}
