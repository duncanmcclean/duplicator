<?php

namespace DoubleThreeDigital\Duplicator;

use Illuminate\Support\Str;
use Statamic\Actions\Action;
use Statamic\Contracts\Entries\Entry;

class DuplicateAction extends Action
{
    protected static $handle = 'Duplicate';

    public function visibleTo($item)
    {
        return $item instanceof Entry;
    }

    public function visibleToBulk($items)
    {
        return false;
    }

    public function run($items, $values)
    {
        $item = $items->first();

        if ($item instanceof Entry) {
            $duplicate = \Statamic\Facades\Entry::make()
                ->collection($item->collection())
                ->blueprint($item->blueprint())
                ->locale($item->locale())
                ->published($item->published())
                ->slug($item->slug().'-duplicate')
                ->data($item->data()->merge(['title' => $item->data()->get('title').' (Duplicate)']))
                ->save();
        }
    }

    public function redirect($items, $values)
    {
        // return back to the entries listing page
    }
}