<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;
use NumberFormatter;

class LocaleNumberFormatter implements Formatter
{
    /**
     * @var NumberFormatter
     */
    public NumberFormatter $formatter;

    /**
     * @param  int|float|string|null  $number
     * @param  string|null  $locale
     * @param  int  $style
     * @param  string|null  $pattern
     * @param  int  $fraction_digits
     * @param  string|null  $grouping_separator
     * @param  string|null  $decimal_separator
     */
    public function __construct(
        public int|float|string|null $number = null,
        public ?string $locale = null,
        public int $style = NumberFormatter::DECIMAL,
        public ?string $pattern = null,
        public int $fraction_digits = 2,
        public ?string $grouping_separator = null,
        public ?string $decimal_separator = null,
    ) {}

    /**
     * Format the number based on locale.
     *
     * @param  Collection  $items
     *
     * @return string|false
     */
    public function format(Collection $items): string|false
    {
        $this->formatter = new NumberFormatter($this->locale ?? app()->getLocale(), $this->style, $this->pattern);

        $this->formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $this->fraction_digits);

        if ($this->grouping_separator) {
            $this->formatter->setSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL, $this->grouping_separator);
        }

        if ($this->decimal_separator) {
            $this->formatter->setSymbol(NumberFormatter::DECIMAL_SEPARATOR_SYMBOL, $this->decimal_separator);
        }

        return $this->formatter->format(
            (float) $this->number
        );
    }
}
