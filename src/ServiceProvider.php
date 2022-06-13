<?php

namespace DoubleThreeDigital\Duplicator;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $actions = [
        Actions\DuplicateAssetAction::class,
        Actions\DuplicateEntryAction::class,
        Actions\DuplicateFormAction::class,
        Actions\DuplicateTermAction::class,
    ];

    public function boot()
    {
        parent::boot();

        $this->handleTranslations();
        $this->handleConfig();
    }

    protected function handleTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'duplicator');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/duplicator'),
        ], 'duplicator-translations');
    }

    protected function handleConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/duplicator.php', 'duplicator');

        $this->publishes([
            __DIR__ . '/../config/duplicator.php' => config_path('duplicator.php'),
        ], 'duplicator-config');
    }

    protected function bootConfig()
    {
        return $this;
    }
}
