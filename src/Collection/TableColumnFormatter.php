<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;

class TableColumnFormatter implements Formatter
{
    /**
     * @param  string|null  $attribute
     */
    public function __construct(
        public ?string $attribute = null
    ) {
    }

    /**
     * Format the snake-cased attributes in readable format for the tables.
     *
     * @return string
     */
    public function format(): string
    {
        return str($this->attribute)
            ->ucfirst()
            ->replace('_', ' ')
            ->value();
    }
}
