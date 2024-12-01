<?php

namespace KanekiYuto\Handy\Console;

use Closure;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\warning;

/**
 * 命令行确认
 *
 * 从 Laravel 原有代码中剥离并进行扩展
 *
 * @author KanekiYuto
 */
trait ConfirmableTrait
{

    /**
     * 在继续操作之前进行确认
     *
     * 此方法仅在生产中要求确认
     *
     * @param string $warning
     * @param bool|Closure|null $callback
     * @return bool
     */
    public function confirmToProceed(string $warning = '当前应用处于生产中！！！', bool|Closure $callback = null): bool
    {
        $callback = is_null($callback) ? $this->getDefaultConfirmCallback() : $callback;

        $shouldConfirm = value($callback);

        if ($shouldConfirm) {
            if ($this->hasOption('force') && $this->option('force')) {
                return true;
            }

            warning($warning);

            $confirmed = confirm('您确定要运行这个命令吗？', default: false);

            if (!$confirmed) {
                $this->components->warn('命令取消');

                return false;
            }
        }

        return true;
    }

    /**
     * 获取默认的确认回调
     *
     * @return Closure
     */
    protected function getDefaultConfirmCallback(): Closure
    {
        return function () {
            // 判断当前环境是否为生产
            return $this->getLaravel()->environment() === 'production';
        };
    }

}
