<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use MichaelRubel\Formatters\Formatter;

class DateTimeFormatter implements Formatter
{
    /**
     * @param  string|null|CarbonInterface  $datetime
     * @param  string|null  $timezone
     * @param  string|null  $datetime_format
     */
    public function __construct(
        public string|null|CarbonInterface $datetime = null,
        public string|null $timezone = null,
        public string|null $datetime_format = 'Y-m-d H:i',
    ) {
        if (empty($this->datetime)) {
            $this->datetime = null;
        }

        if (is_string($this->datetime)) {
            $this->datetime = app(Carbon::class)->parse($this->datetime);
        }

        $this->timezone ??= config('app.timezone', 'UTC');
    }

    /**
     * Format the date and time.
     *
     * @return string|null
     */
    public function format(): ?string
    {
        return $this->datetime
            ?->setTimezone($this->timezone)
            ->translatedFormat($this->datetime_format);
    }
}
