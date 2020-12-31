<?php

namespace DoubleThreeDigital\Duplicator;

use Illuminate\Support\Str;
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
        return true;
    }

    public function run($items, $values)
    {
        collect($items)
            ->each(function ($item) use ($values) {
                if ($item instanceof AnEntry) {
                    $itemParent = $this->getEntryParentFromStructure($item);
                    $itemTitleAndSlug = $this->generateTitleAndSlug($item);

                    $entry = Entry::make()
                        ->collection($item->collection())
                        ->blueprint($item->blueprint()->handle())
                        ->locale(isset($values['site']) ? $values['site'] : $item->locale())
                        ->published($item->published())
                        ->slug($itemTitleAndSlug['slug'])
                        ->data($item->data()->merge([
                            'title' => $itemTitleAndSlug['title'],
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

    /**
     * This method has been copied from the Duplicate Entry code in Statamic v2.
     * It's been updated to also deal with entry titles.
     */
    protected function generateTitleAndSlug(AnEntry $entry, $attempt = 1)
    {
        $title = $entry->get('title');
        $slug = $entry->slug();

        if ($attempt == 1) {
            $title = $title . __('duplicator::messages.duplicated_title');
        }

        if ($attempt !== 1) {
            if (! Str::contains($title, __('duplicator::messages.duplicated_title'))) {
                $title .= __('duplicator::messages.duplicated_title');
            }

            $title .= ' (' . $attempt . ')';
        }

        $slug .= '-' . $attempt;

        // If the slug we've just built already exists, we'll try again, recursively.
        if (Entry::findBySlug($slug, $entry->collection()->handle())) {
            $generate = $this->generateTitleAndSlug($entry, $attempt + 1);

            $title = $generate['title'];
            $slug = $generate['slug'];
        }

        return [
            'title' => $title,
            'slug' => $slug,
        ];
    }
}
