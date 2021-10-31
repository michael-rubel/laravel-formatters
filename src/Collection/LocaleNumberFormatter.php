<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;
use NumberFormatter;

class LocaleNumberFormatter implements Formatter
{
    /**
     * @var string
     */
    public string $locale_key = 'locale';

    /**
     * @var string
     */
    public string $number_key = 'number';

    /**
     * @var string
     */
    public string $style_key = 'style';

    /**
     * @var string
     */
    public string $pattern_key = 'pattern';

    /**
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

        return $formatter->format(
            (float) $items->get($this->number_key) ?? $this->default_number
        );
    }
}
