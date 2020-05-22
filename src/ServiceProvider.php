<?php

namespace DoubleThreeDigital\Duplicator;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        parent::boot();

        DuplicateAction::register();
    }
}
