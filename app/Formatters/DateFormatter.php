<?php

declare(strict_types=1);

namespace App\Formatters;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;

class DateFormatter implements Formatter
{
    /**
     * @var string
     */
    public string $date_format = 'Y.m.d';

    /**
     * Format the date.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $date = $items->first();

        if ($date instanceof Carbon) {
            return $date->format($this->date_format);
        }

        return app(Carbon::class)
            ->parse($date)
            ->format($this->date_format);
    }
}
