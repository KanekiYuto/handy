<?php

namespace KanekiYuto\Handy\Cascade\Trait\Laravel;

use stdClass;
use ReflectionMethod;
use ReflectionException;
use function Laravel\Prompts\error;

trait Helper
{

	/**
	 * 自动判断是否需要使用方法参数 [如果值不是默认的话]
	 *
	 * @param  string  $class
	 * @param  string  $fn
	 * @param  array   $params
	 *
	 * @return stdClass
	 */
	protected function useParams(string $class, string $fn, array $params): stdClass
	{
		$validParams = [];

		try {
			$method = new ReflectionMethod($class, $fn);

			foreach ($method->getParameters() as $param) {
				$paramName = $param->getName();
				$value = $params['$'.$paramName];

				if ($param->isOptional() && $value === $param->getDefaultValue()) {
					continue;
				}

				$validParams[$paramName] = $value;
			}
		} catch (ReflectionException $e) {
			error($e->getMessage());
		}

		return (object) $validParams;
	}

}