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

        return is_string($extracted)
            ? $extracted
            : '';
    }
}
