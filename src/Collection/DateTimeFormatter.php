<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use MichaelRubel\Formatters\Formatter;

class DateTimeFormatter implements Formatter
{
    /**
     * @param string|CarbonInterface $datetime
     * @param string|null $timezone
     * @param string $datetime_format
     */
    public function __construct(
        public string|CarbonInterface $datetime,
        public string|null $timezone = null,
        public string $datetime_format = 'Y-m-d H:i',
    ) {
        if (! $this->timezone) {
            $this->timezone = config('app.timezone');
        }

        if (! $this->datetime instanceof CarbonInterface) {
            $this->datetime = app(Carbon::class)->parse($this->datetime);
        }
    }

    /**
     * Format the date and time.
     *
     * @return string
     */
    public function format(): string
    {
        return $this->datetime
            ->setTimezone($this->timezone)
            ->format($this->datetime_format);
    }
}
