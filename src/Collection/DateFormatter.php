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
     * @var mixed
     */
    public mixed $instance;

    /**
     * @var mixed
     */
    public mixed $timezone;

    /**
     * Format the date.
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
            $this->getTimezone($items);
        }

        if (! $this->instance instanceof CarbonInterface) {
            $this->instance = app(Carbon::class)->parse($this->instance);
        }

        return $this->instance
            ->setTimezone($this->timezone)
            ->format($this->date_format);
    }

    /**
     * @param Collection $items
     *
     * @return void
     */
    protected function getInstance(Collection $items): void
    {
        $this->instance = $items->first();
    }

    /**
     * @param Collection $items
     *
     * @return void
     */
    protected function getTimezone(Collection $items): void
    {
        $this->timezone = config('app.timezone');

        if (count($items) > 1) {
            $this->timezone = $items->last();
        }
    }
}
