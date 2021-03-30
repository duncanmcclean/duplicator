<?php

namespace DoubleThreeDigital\Duplicator;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $actions = [
        Actions\DuplicateEntryAction::class,
    ];

    public function boot()
    {
        parent::boot();

        $this->handleTranslations();
        $this->handleConfig();
        $this->bootActions();
    }

    protected function handleTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'duplicator');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/duplicator'),
        ], 'duplicator-translations');
    }

    protected function handleConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/duplicator.php', 'duplicator');

        $this->publishes([
            __DIR__.'/../config/duplicator.php' => config_path('duplicator.php'),
        ], 'duplicator-config');
    }

    protected function bootActions()
    {
        foreach ($this->actions as $class) {
            $class::register();
        }

        return $this;
    }

    protected function bootConfig()
    {
        return $this;
    }
}
