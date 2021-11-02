<?php

declare(strict_types=1);

namespace App\Formatters;

use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;

class ExampleFormatter implements Formatter
{
    /**
     * Format the date.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        return $items->first();
    }
}
