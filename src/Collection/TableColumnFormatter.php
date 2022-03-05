<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;
use MichaelRubel\Formatters\Traits\HelpsFormatData;

class TableColumnFormatter implements Formatter
{
    use HelpsFormatData;

    /**
     * Format the snake-cased attributes in readable format for the tables.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        return Str::ucfirst(
            Str::replace(
                '_',
                ' ',
                $this->extractStringFromCollection($items)
            )
        );
    }
}
