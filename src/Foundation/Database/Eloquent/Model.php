<?php

namespace KanekiYuto\Handy\Foundation\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use KanekiYuto\Handy\Trace\TraceEloquent;
use KanekiYuto\Handy\Cascade\Concerns\HasEloquentTrace;

/**
 * Base model
 *
 * @author KanekiYuto
 */
class Model extends BaseModel
{

    use HasEloquentTrace;

	/**
	 * Trace class
	 *
	 * @var string<TraceEloquent>
	 */
	protected string $trace;

}
