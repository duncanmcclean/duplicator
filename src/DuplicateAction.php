<?php

namespace DoubleThreeDigital\Duplicator;

use Statamic\Actions\Action;
use Statamic\Contracts\Entries\Entry as AnEntry;
use Statamic\Facades\Entry;
use Statamic\Facades\Site;
use Statamic\Sites\Site as SitesSite;

class DuplicateAction extends Action
{
    public static function title()
    {
        return __('duplicator::messages.duplicate');
    }

    protected function fieldItems()
    {
        if (Site::all()->count() > 1) {
            return [
                'site' => [
                    'type' => 'select',
                    'instructions' => __('duplicator::messages.fields.site.instructions'),
                    'validate' => 'required|in:'.Site::all()->keys()->join(','),
                    'options' => Site::all()
                        ->map(function (SitesSite $site) {
                            return $site->name();
                        })
                        ->toArray(),
                ],
            ];
        }

        return [];
    }

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
            ->each(function ($item) use ($values) {
                if ($item instanceof AnEntry) {
                    $itemParent = $this->getEntryParentFromStructure($item);

                    $entry = Entry::make()
                        ->collection($item->collection())
                        ->blueprint($item->blueprint()->handle())
                        ->locale(isset($values['site']) ? $values['site'] : $item->locale())
                        ->published($item->published())
                        ->slug($item->slug().__('duplicator::messages.duplicated_slug'))
                        ->data($item->data()->merge([
                            'title' => $item->data()->get('title').__('duplicator::messages.duplicated_title')
                        ]));

                    $entry->save();

                    if ($itemParent && $itemParent !== $item->id()) {
                        $entry->structure()
                            ->in(isset($values['site']) ? $values['site'] : $item->locale())
                            ->appendTo($itemParent->id(), $entry)
                            ->save();
                    }
                }
            });
    }

    protected function getEntryParentFromStructure(AnEntry $entry)
    {
        if (! $entry->structure()) {
            return null;
        }

        $parentEntry = $entry
            ->structure()
            ->in($entry->locale())
            ->page($entry->id())
            ->parent();

        if (is_null($parentEntry) || $entry->structure()->in($entry->locale())->root() === $parentEntry->id()) {
            return null;
        }

        return $parentEntry;
    }
}
