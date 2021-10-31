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
            NumberFormatter::DECIMAL
        );

        return $formatter->format(
            (float) $items->get($this->number_key) ?? 0
        );
    }
}
