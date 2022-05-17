<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class TableColumnFormatter implements Formatter
{
    /**
     * @param string|null $string
     */
    public function __construct(
        public ?string $string
    ) {
    }

    /**
     * Format the snake-cased attributes in readable format for the tables.
     *
     * @return string
     */
    public function format(): string
    {
        return Str::ucfirst(
            Str::replace(
                '_',
                ' ',
                $this->string
            )
        );
    }
}
