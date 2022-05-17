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
     * @param int|float|string|null $number
     * @param string|null           $locale
     * @param int                   $style
     * @param string|null           $pattern
     * @param int                   $fraction_digits
     */
    public function __construct(
        public int|float|string|null $number = null,
        public ?string $locale = null,
        public int $style = NumberFormatter::DECIMAL,
        public ?string $pattern = null,
        public int $fraction_digits = 2
    ) {
        $this->locale = $this->locale ?? app()->getLocale();

        $this->formatter = new NumberFormatter(
            $this->locale,
            $this->style,
            $this->pattern
        );

        $this->formatter->setAttribute(
            NumberFormatter::FRACTION_DIGITS,
            $this->fraction_digits
        );
    }

    /**
     * Format the number based on locale.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        return $this->formatter->format(
            (float) $this->number
        );
    }
}
