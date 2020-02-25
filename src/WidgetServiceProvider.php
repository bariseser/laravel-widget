<?php

namespace Bariseser\LaravelWidget;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class WidgetServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WidgetManager::class, WidgetManager::class);
    }

    /**
     * Bootstrap the application events.
     *
     * @return string
     */
    public function boot()
    {
        Blade::directive("widget", function ($className) {
            if (Str::startsWith($className, '(')) {
                $className = substr($className, 1, -1); // @widget(Widget\Test::class) => Widget\Test::class
            }
            return sprintf("<?php echo app()->make('%s' )->handle(%s);?>", WidgetManager::class, $className);
        });
    }
}
