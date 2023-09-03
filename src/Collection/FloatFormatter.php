<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use MichaelRubel\Formatters\Formatter;
use Num\Num;

class FloatFormatter implements Formatter
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
     * Format the value as a float using the specified decimal separator.
     *
     * @return float The formatted float value.
     */
    public function format(): float
    {
        return Num::float($this->value, $this->getDecimalSeparator($this->decimal_separator));
    }
}
