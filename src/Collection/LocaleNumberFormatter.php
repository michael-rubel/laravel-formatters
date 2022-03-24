<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;
use MichaelRubel\Formatters\Traits\HelpsFormatData;
use NumberFormatter;

class LocaleNumberFormatter implements Formatter
{
    use HelpsFormatData;

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
     * Extendable fraction digits.
     *
     * @var int
     */
    public int $fraction_digits = 2;

    /**
     * Format the date and time.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $items = $this->getFirstFrom($items);

        $formatter = new NumberFormatter(
            $items->get($this->locale_key) ?? app()->getLocale(),
            $items->get($this->style_key) ?? NumberFormatter::DECIMAL
        );

        $formatter->setAttribute(
            NumberFormatter::FRACTION_DIGITS,
            $this->fraction_digits
        );

        return $formatter->format(
            (float) (
                $items->get($this->number_key) ?? $this->extractStringFromCollection($items)
            )
        );
    }
}
