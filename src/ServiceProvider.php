<?php

namespace DoubleThreeDigital\Duplicator;

use DoubleThreeDigital\Duplicator\Actions\DuplicateEntryAction;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        parent::boot();

        DuplicateEntryAction::register();
    }
}
