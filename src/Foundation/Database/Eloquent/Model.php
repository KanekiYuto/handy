<?php

namespace KanekiYuto\Handy\Foundation\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use KanekiYuto\Handy\Trace\TraceEloquent;

/**
 * Base model
 *
 * @author KanekiYuto
 */
class Model extends BaseModel
{

	/**
	 * Trace class
	 *
	 * @var string<TraceEloquent>
	 */
	protected string $trace;

}
