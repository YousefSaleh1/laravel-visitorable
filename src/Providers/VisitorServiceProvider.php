<?php

namespace Devyousef\Visitor\Providers;

use Illuminate\Support\ServiceProvider;

class VisitorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateVisitorsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_visitors_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_visitors_table.php'),
                ], 'migrations');
            }
        }
    }
}
