<?php

namespace DoubleThreeDigital\Duplicator\Actions;

use Illuminate\Support\Arr;
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
            ->each(function ($item) {
                if ($item instanceof Asset) {
                    $duplicatePath = str_replace($item->filename(), "{$item->filename()}-02", $item->path());

                    $assetData = Arr::except(
                        $item->data(),
                        config('duplicator.ignored_fields.assets')
                    );

                    if (config('duplicator.fingerprint') === true) {
                        $assetData['is_duplicate'] = true;
                    }

                    Storage::disk($item->container()->diskHandle())->copy($item->path(), $duplicatePath);

                    $asset = AssetAPI::make()
                        ->container($item->container()->handle())
                        ->path($duplicatePath)
                        ->data($assetData);

                    $asset->save();
                }
            });
    }
}
