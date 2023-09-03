<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Num\Num;
use MichaelRubel\Formatters\Formatter;
use Num\Enums\DecimalSeparator;

class FloatFormatter implements Formatter
{
    /**
     * @param int|float|string|null $value The value to format.
     * @param string|null $decimal_separator The decimal separator to use for formatting.
     */
    public function __construct(
        public int|float|string|null $value = null,
        public ?string $decimal_separator = null,
    ) {
    }

    /**
     * Get the decimal separator as a DecimalSeparator enum value.
     *
     * @param string|null $decimal_separator The decimal separator to convert.
     * @return DecimalSeparator|null The DecimalSeparator enum value.
     */
    private function getDecimalSeparator(?string $decimal_separator): ?DecimalSeparator
    {
        switch ($decimal_separator) {
            case '.':
                return DecimalSeparator::POINT;
            case ',':
                return DecimalSeparator::COMMA;
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
