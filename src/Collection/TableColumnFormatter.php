<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class TableColumnFormatter implements Formatter
{
    /**
     * @param string|null $attribute
     */
    public function __construct(
        public ?string $attribute = ''
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
                (string) $this->attribute
            )
        );
    }
}
