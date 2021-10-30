<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters;

use Illuminate\Support\Collection;

interface Formatter
{
    /**
     * Format something.
     *
     * @param Collection $items
     */
    public function format(Collection $items);
}