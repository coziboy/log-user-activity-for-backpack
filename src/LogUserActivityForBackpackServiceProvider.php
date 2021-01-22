<?php

namespace Coziboy\LogUserActivityForBackpack;

use Illuminate\Support\ServiceProvider;

class LogUserActivityForBackpackServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'log-user');
        $this->loadRoutesFrom(__DIR__ . '/routes/backpack/loguseractivity.php');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        // return ['log-user-activity-for-backpack'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
    }
}
