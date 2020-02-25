<?php


namespace Bariseser\LaravelWidget;


use Illuminate\View\View;

class WidgetManager
{

    /**
     * @param $widgetName
     * @return mixed
     */
    public function handle($widgetName)
    {

        if (!class_exists($widgetName)) {
            throw new \InvalidArgumentException(sprintf("Widget [%s] not found!", $widgetName));
        }

        $instance = app()->make($widgetName);
        if (!$instance instanceof WidgetInterface) {
            throw new \InvalidArgumentException(sprintf("Widget [%s] must extend [%s]!", $widgetName,
                WidgetInterface::class));
        }

        $view = $instance->show();

        if ($view instanceof View) {
            return $view->render();
        }

        return $view;
    }
}
