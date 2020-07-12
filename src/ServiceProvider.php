<?php

namespace DoubleThreeDigital\Duplicator;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->handleTranslations();

        DuplicateAction::register();
    }

    protected function handleTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'duplicator');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/duplicator'),
        ], 'duplicator-translations');
    }
}
