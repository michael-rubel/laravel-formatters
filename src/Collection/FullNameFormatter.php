<?php

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class FullNameFormatter implements Formatter
{
    /**
     * @param string|null $name
     */
    public function __construct(public ?string $name)
    {
        //
    }

    /**
     * Format the date.
     *
     * @return string
     */
    public function format(): string
    {
        return Str::of($this->name)
            ->squish()
            ->headline()
            ->value();
    }
}