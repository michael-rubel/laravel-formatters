<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;

class FullNameFormatter implements Formatter
{
    /**
     * @param  string|null  $name
     */
    public function __construct(public ?string $name)
    {
        //
    }

    /**
     * Format the full name.
     *
     * @return string
     */
    public function format(): string
    {
        return str($this->name)
            ->squish()
            ->headline()
            ->value();
    }
}
