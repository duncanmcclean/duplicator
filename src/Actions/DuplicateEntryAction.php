<?php

namespace DoubleThreeDigital\Duplicator\Actions;

use Statamic\Actions\Action;
use Statamic\Contracts\Entries\Entry;

class DuplicateEntryAction extends Action
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
        // TODO: handle duplication
    }

    public function redirect($items, $values)
    {
        // return back to the entries listing page
    }
}