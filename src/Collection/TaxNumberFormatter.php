<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use MichaelRubel\Formatters\Formatter;

class TaxNumberFormatter implements Formatter
{
    /**
     * @var string
     */
    public string $key_number = 'tax_number';

    /**
     * @var string
     */
    public string $key_country = 'country';

    /**
     * Format the Tax Number.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $tax_number = preg_replace(
            '/[^\d\w]/',
            '',
            $items->get($this->key_number, '')
        );

        if (empty($items->get($this->key_country))) {
            return $tax_number;
        }

        $country = strtoupper($items->get($this->key_country));

        $prefix = strtoupper(
            substr(
                $tax_number,
                0,
                strlen($country)
            )
        );

        return $prefix === $country
            ? $country . substr(
                $tax_number,
                strlen($country)
            )
            : $country . $tax_number;
    }
}
