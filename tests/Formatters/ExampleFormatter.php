<?php

declare(strict_types=1);

namespace App\Formatters;

use Carbon\CarbonInterface;
use MichaelRubel\Formatters\Formatter;

class ExampleFormatter implements Formatter
{
    /**
     * @param  CarbonInterface  $carbon
     */
    public function __construct(
        public CarbonInterface $carbon
    ) {
        //
    }


    /**
     * Format the date.
     *
     * @return string|null
     */
    public function format(): ?string
    {
        return $this->carbon->toDateTimeString();
    }
}
