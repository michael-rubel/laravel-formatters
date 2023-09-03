<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;
use Num\Num;

class IntFormatter implements Formatter
{
    /**
     * @param  int|float|string|null  $value The value to format.
     * @param  string|null  $decimal_separator The decimal separator to use for formatting.
     */
    public function __construct(
        public int|float|string|null $value = null,
        public ?string $decimal_separator = null,
    ) {
    }

    /**
     * Get the valid decimal separator or null.
     *
     * @param  string|null  $decimal_separator The decimal separator to convert.
     * @return string|null The valid decimal separator or null.
     */
    private function getDecimalSeparator(?string $decimal_separator): ?string
    {
        switch ($decimal_separator) {
            case '.':
                return '.';
            case ',':
                return ',';
            default:
                return null;
        }
    }

    /**
     * Format the value as an integer using the specified decimal separator.
     *
     * @return int The formatted integer value.
     */
    public function format(): int
    {
        return Num::int($this->value, $this->getDecimalSeparator($this->decimal_separator));
    }
}
