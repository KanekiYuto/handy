<?php

use KanekiYuto\Handy\Cascade1\Cascade;
use KanekiYuto\Handy\Cascade\Blueprint;

Cascade::configure()
	->withBlueprint(function (Blueprint $table) {
		$table->string('111')->hidden();
	});