<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use MichaelRubel\Formatters\Formatter;

class DateTimeFormatter implements Formatter
{
    /**
     * @param string|null|CarbonInterface $datetime
     * @param string|null $timezone
     * @param string|null $datetime_format
     */
    public function __construct(
        public string|CarbonInterface|null $datetime = null,
        public string|null $timezone = null,
        public string|null $datetime_format = null,
    ) {
        if (! $this->timezone) {
            $this->timezone = config('app.timezone');
        }

        if (! $this->datetime instanceof CarbonInterface) {
            $this->datetime = app(Carbon::class)->parse($this->datetime);
        }

        if (! $this->datetime_format) {
            $this->datetime_format = 'Y-m-d H:i';
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
