<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;
use NumberFormatter;

class LocaleNumberFormatter implements Formatter
{
    /**
     * "Locale" key to pass to the collection of $items.
     *
     * @var string
     */
    public string $locale_key = 'locale';

    /**
     * "Number" key to pass to the collection of $items.
     *
     * @var string
     */
    public string $number_key = 'number';

    /**
     * "Style" key to pass to the collection of $items.
     *
     * @var string
     */
    public string $style_key = 'style';

    /**
     * "Pattern" key to pass to the collection of $items.
     *
     * @var string
     */
    public string $pattern_key = 'pattern';

    /**
     * Extendable fraction digits.
     *
     * @var int
     */
    public int $fraction_digits = 2;

    /**
     * Default number if $number_key isn't passed.
     *
     * @var float
     */
    public float $default_number = 0;

    /**
     * Format the date and time.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $formatter = new NumberFormatter(
            $items->get($this->locale_key) ?? app()->getLocale(),
            $items->get($this->style_key) ?? NumberFormatter::DECIMAL,
            $items->get($this->pattern_key) ?? null
        );

        $formatter->setAttribute(
            NumberFormatter::FRACTION_DIGITS,
            $this->fraction_digits
        );

        return $formatter->format(
            (float) $items->get($this->number_key) ?? $this->default_number
        );
    }
}
