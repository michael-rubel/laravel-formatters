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
     * @param string|CarbonInterface $date
     * @param string|null $timezone
     * @param string $date_format
     */
    public function __construct(
        public string|CarbonInterface $date,
        public string|null $timezone = null,
        public string $date_format = 'Y-m-d',
    ) {
        if (! $this->timezone) {
            $this->timezone = config('app.timezone');
        }

        if (! $this->date instanceof CarbonInterface) {
            $this->date = app(Carbon::class)->parse($this->date);
        }
    }

    /**
     * Format the date.
     *
     * @return string
     */
    public function format(): string
    {
        return $this->date
            ->setTimezone($this->timezone)
            ->format($this->date_format);
    }
}
