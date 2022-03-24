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
     * @var object|array|string
     */
    public object|array|string $instance;

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
        $this->instance = $items->first();

        if (is_array($this->instance)) {
            $this->instance = current($this->instance);
        }

        $this->timezone = config('app.timezone');

        if (count($items) > 1) {
            $this->timezone = $items->last();
        }

        if (! $this->instance instanceof CarbonInterface) {
            $this->instance = app(Carbon::class)->parse($this->instance);
        }

        return $this->instance
            ->setTimezone($this->timezone)
            ->format($this->date_format);
    }
}
