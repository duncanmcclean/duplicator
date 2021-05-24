<?php

namespace DoubleThreeDigital\Duplicator\Actions;

use Illuminate\Support\Facades\Storage;
use Statamic\Actions\Action;
use Statamic\Contracts\Assets\Asset;
use Statamic\Facades\Asset as AssetAPI;

class DuplicateAssetAction extends Action
{
    public static function title()
    {
        return __('duplicator::messages.duplicate');
    }

    public function visibleTo($item)
    {
        return $item instanceof Asset;
    }

    public function visibleToBulk($items)
    {
        return $this->visibleTo($items->first());
    }

    public function run($items, $values)
    {
        collect($items)
            ->each(function ($item) use ($values) {
                if ($item instanceof Asset) {
                    $duplicatePath = str_replace($item->filename(), "{$item->filename()}-02", $item->path());

                    $asset = AssetAPI::make()
                        ->container($item->container()->handle())
                        ->path($duplicatePath)
                        ->writeMeta($item->meta());

                    Storage::disk($item->container()->diskHandle())->copy($item->path(), $duplicatePath);
                }
            });
    }
}
