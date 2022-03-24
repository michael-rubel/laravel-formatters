<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;

class DateFormatter implements Formatter
{
    /**
     * @var string
     */
    public string $date_format = 'Y-m-d';

    /**
     * @var object|array
     */
    public object|array $instance;

    /**
     * @var string
     */
    public string $timezone;

    /**
     * Format the date.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $instance = $items->first();

        if (is_array($instance)) {
            $instance = current($instance);
        }

        $timezone = config('app.timezone');

        if (count($items) > 1) {
            $timezone = $items->last();
        }

        if (! $instance instanceof CarbonInterface) {
            $instance = app(Carbon::class)->parse($instance);
        }

        return $instance
            ->setTimezone($timezone)
            ->format($this->date_format);
    }
}
