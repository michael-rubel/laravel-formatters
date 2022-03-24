<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Traits;

use Illuminate\Support\Collection;

trait HelpsFormatData
{
    /**
     * @param Collection $collection
     *
     * @return string
     */
    private function extractStringFromCollection(Collection $collection): string
    {
        $extracted = $collection->first();

        if (is_array($extracted)) {
            $extracted = current($extracted);
        }

        return is_string($extracted)
            ? $extracted
            : (string) $extracted;
    }

    /**
     * @param Collection $items
     *
     * @return Collection
     */
    private function getFirstFrom(Collection $items): Collection
    {
        return collect(
            $items->first()
        );
    }
}
