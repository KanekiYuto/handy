<?php

namespace KanekiYuto\Handy;

use Closure;
use Illuminate\Support\ServiceProvider;
use KanekiYuto\Handy\Cascades\Builder;
use KanekiYuto\Handy\Cascades\Console\CascadeCommand;
use KanekiYuto\Handy\Support\Facades\Schema;

/**
 * 服务提供者
 *
 * @author KanekiYuto
 */
class HandyServiceProvider extends ServiceProvider
{

    /**
     * 命令注册
     *
     * @var array
     */
    protected array $commands = [
        CascadeCommand::class,
    ];

    /**
     * 注册服务
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerCommands($this->commands);

        $this->app->bind(Schema::FACADE_ACCESSOR, Builder::class);
    }

    /**
     * 注册给定的命令
     *
     * @param array $commands
     *
     * @return void
     */
    protected function registerCommands(array $commands): void
    {
        foreach ($commands as $command) {
            $this->app->singleton($command, $this->matchCommand($command));
        }

        $this->commands(array_values($commands));
    }

    /**
     * 匹配对应的命令函数
     *
     * @param string $className
     *
     * @return Closure
     */
    protected function matchCommand(string $className): Closure
    {
        return match ($className) {
            CascadeCommand::class => function () {
                return new CascadeCommand();
            }
        };
    }

    /**
     * 引导服务
     *
     * @return void
     */
    public function boot()
    {
        // ...
    }

}
