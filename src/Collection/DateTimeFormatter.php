<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;

class DateTimeFormatter implements Formatter
{
    /**
     * @var string
     */
    public string $datetime_format = 'Y-m-d H:i';

    /**
     * Format the date and time.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $datetime = $items->first();

        if ($datetime instanceof Carbon) {
            return $datetime->format($this->datetime_format);
        }

        return app(Carbon::class)
            ->parse($datetime)
            ->format($this->datetime_format);
    }
}
