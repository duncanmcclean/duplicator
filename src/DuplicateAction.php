<?php

namespace DoubleThreeDigital\Duplicator;

use Statamic\Actions\Action;
use Statamic\Contracts\Entries\Entry as AnEntry;
use Statamic\Facades\Entry;

class DuplicateAction extends Action
{
    protected static $handle = 'Duplicate';

    public function visibleTo($item)
    {
        return $item instanceof AnEntry;
    }

    public function visibleToBulk($items)
    {
        return false;
    }

    public function run($items, $values)
    {
        collect($items)
            ->each(function ($item) {
                if ($item instanceof AnEntry) {
                    Entry::make()
                        ->collection($item->collection())
                        ->blueprint($item->blueprint()->handle())
                        ->locale($item->locale())
                        ->published($item->published())
                        ->slug($item->slug().'-duplicate')
                        ->data($item->data()->merge(['title' => $item->data()->get('title').' (Duplicate)']))
                        ->save();
                }
            });
    }
}
