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
    public string $key_country = 'country_iso';

    /**
     * Format the Tax Number.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $tax_number = $this->getCleanTaxNumber($items);

        if (empty($items->get($this->key_country))) {
            return $tax_number;
        }

        $country = $this->getCountry($items);

        $prefix = $this->getPrefix($tax_number, $country);

        return $this->getFullTaxNumber($prefix, $country, $tax_number);
    }

    /**
     * @param Collection $items
     * @return string
     */
    private function getCountry(Collection $items): string
    {
        return strtoupper($items->get($this->key_country));
    }

    /**
     * @param string $tax_number
     * @param string $country
     * @return string
     */
    private function getPrefix(string $tax_number, string $country): string
    {
        return strtoupper(
            substr(
                (string) $tax_number,
                0,
                strlen($country)
            )
        );
    }

    /**
     * @param string $prefix
     * @param string $country
     * @param string $tax_number
     * @return string
     */
    private function getFullTaxNumber(string $prefix, string $country, string $tax_number): string
    {
        return $prefix === $country
            ? $country . substr(
                $tax_number,
                strlen($country)
            )
            : $country . $tax_number;
    }

    /**
     * @param Collection $items
     * @return string
     */
    private function getCleanTaxNumber(Collection $items): string
    {
        return (string) preg_replace(
            '/[^\d\w]/',
            '',
            $items->get($this->key_number, '')
        );
    }
}
