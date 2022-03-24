<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;
use MichaelRubel\Formatters\Traits\HelpsFormatData;

class DateTimeFormatter implements Formatter
{
    use HelpsFormatData;

    /**
     * @var string
     */
    public string $datetime_format = 'Y-m-d H:i';

    /**
     * @var mixed
     */
    public mixed $instance;

    /**
     * @var mixed
     */
    public mixed $timezone;

    /**
     * Format the date and time.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        if (! isset($this->instance)) {
            $this->getInstance($items);
        }

        if (! isset($this->timezone)) {
            $this->setTimezone($items);
        }

        if (! $this->instance instanceof CarbonInterface) {
            $this->instance = app(Carbon::class)->parse($this->instance);
        }

        return $this->instance
            ->setTimezone($this->timezone)
            ->format($this->datetime_format);
    }

    /**
     * @param Collection $items
     *
     * @return void
     */
    public function getInstance(Collection $items): void
    {
        $this->instance = $items->first();

        if (is_array($this->instance)) {
            $this->instance = current($this->instance);
        }
    }

    /**
     * @param Collection $items
     *
     * @return void
     */
    public function setTimezone(Collection $items): void
    {
        $this->timezone = config('app.timezone');

        if (count($items) > 1) {
            $this->timezone = $items->last();
        }
    }
}
