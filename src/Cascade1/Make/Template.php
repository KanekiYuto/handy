<?php

namespace KanekiYuto\Handy\Cascade1\Make;

use Illuminate\Support\Str;
use KanekiYuto\Handy\Cascade1\Builder;

/**
 * 存根模板
 *
 * @author KanekiYuto
 */
trait Template
{

	/**
	 * 制表
	 *
	 * @param  string  $string
	 * @param  int     $quantity
	 * @param  bool    $first
	 *
	 * @return string
	 */
	protected final function tab(string $string, int $quantity, bool $first = true): string
	{
		$string = explode("\n", $string);
		$tabString = [];

		foreach ($string as $key => $value) {
			if ($key !== 0 || $first === false) {
				$value = str_repeat("\t", $quantity).$value;
			}

			$tabString[] = $value;
		}

		return implode("\n", $tabString);
	}

	/**
	 * 常量声明模板
	 *
	 * @param  string        $const
	 * @param  string|array  $value
	 *
	 * @return string
	 */
	protected final function templateConst(string $const, string|array $value): string
	{
		if (is_array($value)) {
			$value = implode(', ', $value);
			$value = "[$value]";
		}

		if (is_string($value)) {
			$value = "'$value'";
		}

		$stubsDisk = Builder::useDisk(Builder::getStubsPath());
		$stub = $stubsDisk->get('template.const.stub');

		$stub = $this->param('const', $const, false, $stub);

		return $this->param('value', $value, false, $stub);
	}

	/**
	 * 属性注释模板
	 *
	 * @param  string  $comment
	 * @param  string  $var
	 *
	 * @return string
	 */
	protected final function templatePropertyComment(string $comment, string $var): string
	{
		$stubsDisk = Builder::useDisk(Builder::getStubsPath());
		$stub = $stubsDisk->get('template.comment.property.stub');

		$stub = $this->param('comment', $comment, false, $stub);

		return $this->param('@var', "@var ".$var, false, $stub);
	}

	protected final function formattingStub(string $stub): string
	{
		$stubArray = explode("\n", $stub);
		$recordRow = [];
		$returnStub = [];

		foreach ($stubArray as $index => $str) {
			if ($index === 0 || $index === count($stubArray) - 1) {
				$returnStub[] = $str;
				continue;
			}

//			if (in_array($str, ['{', '}', '<?php'])) {
//				$returnStub[] = $str;
//				continue;
//			}

			if (in_array($index, $recordRow)) {
				continue;
			}

			$lastRow = $stubArray[$index - 1];
			$nextRow = $stubArray[$index + 1];

			$nullRow = Str::of($str)
				->replace(' ', '')
				->toString();

			if (empty($lastRow) && empty($nextRow) && empty($nullRow)) {
				$recordRow[] = $index + 1;
				continue;
			}

			$returnStub[] = $str;
			$recordRow = [];
		}

		return implode("\n", $returnStub);
	}

}
