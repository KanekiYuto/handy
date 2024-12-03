<?php

namespace KanekiYuto\Handy\Cascades\Model;

use Illuminate\Database\Eloquent\Model;
use KanekiYuto\Handy\Trace\TraceEloquent;

/**
 * Base model
 *
 * @author KanekiYuto
 */
abstract class BaseModel extends Model
{

	/**
	 * Trace class
	 *
	 * @var string<TraceEloquent>
	 */
	protected string $trace;

}
