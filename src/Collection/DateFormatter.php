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
        public ?string $timezone = null,
        public ?string $date_format = 'Y-m-d',
    ) {
        if (empty($this->date)) {
            $this->date = null;
        }

        if (is_string($this->date)) {
            $this->date = app(Carbon::class)->parse($this->date);
        }

        $this->timezone ??= config('app.timezone', 'UTC');
    }

    /**
     * Format the date.
     *
     * @return string|null
     */
    public function format(): ?string
    {
        return $this->date
            ?->setTimezone($this->timezone)
            ->translatedFormat($this->date_format);
    }
}
