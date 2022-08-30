<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use MichaelRubel\Formatters\Formatter;

class DateFormatter implements Formatter
{
    /**
     * @param  string|CarbonInterface|null  $date
     * @param  string|null  $timezone
     * @param  string|null  $date_format
     */
    public function __construct(
        public string|null|CarbonInterface $date = null,
        public string|null $timezone = null,
        public string|null $date_format = 'Y-m-d',
    ) {
        if (! $this->date instanceof CarbonInterface) {
            $this->date = app(Carbon::class)->parse($this->date);
        }

        $this->timezone    = $this->timezone ?? config('app.timezone', 'UTC');
        $this->date_format = $this->date_format ?? 'Y-m-d';
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
            ->translatedFormat($this->date_format);
    }
}
