<?php

namespace KanekiYuto\Handy\Console\Trait;

use Closure;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\warning;

/**
 * Command line acknowledgment
 *
 * @author KanekiYuto
 */
trait ConfirmableTrait
{

	/**
	 * Confirm before proceeding
	 *
	 * @param  string  $warning
	 * @param  bool|Closure|null  $callback
	 *
	 * @return bool
	 */
	public function confirmToProceed(
		string $warning = 'The application is currently in production！！！',
		bool|Closure $callback = null
	): bool {
		$callback = is_null($callback) ? $this->getDefaultConfirmCallback() : $callback;

		$shouldConfirm = value($callback);

		if ($shouldConfirm) {
			if ($this->hasOption('force') && $this->option('force')) {
				return true;
			}

			warning($warning);

			$confirmed = confirm('Are you sure you want to run this command?', default: false);

			if (!$confirmed) {
				$this->components->warn('Cancel.');

				return false;
			}
		}

		return true;
	}

	/**
	 * Gets the default confirmation callback
	 *
	 * @return Closure
	 */
	protected function getDefaultConfirmCallback(): Closure
	{
		return function () {
			// Determine whether the current environment is in production
			return $this->getLaravel()->environment() === 'production';
		};
	}

}
