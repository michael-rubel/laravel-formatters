<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class TaxNumberFormatter implements Formatter
{
    /**
     * @var string
     */
    public string $number_key = 'tax_number';

    /**
     * @var string
     */
    public string $country_key = 'country_iso';

    /**
     * Format the Tax Number.
     *
     * @param Collection $items
     *
     * @return string
     */
    public function format(Collection $items): string
    {
        $tax_number = $this->cleanupTaxNumber($items);

        if (empty($items->get($this->country_key))) {
            return $tax_number;
        }

        return $this->getFullTaxNumber(
            $tax_number,
            $this->getCountry($items)
        );
    }

    /**
     * @param Collection $items
     * @return string
     */
    private function getCountry(Collection $items): string
    {
        return (string) Str::of(
            $items->get($this->country_key)
        )->upper();
    }

    /**
     * @param string $tax_number
     * @return string
     */
    private function getPrefix(string $tax_number): string
    {
        return (string) Str::of($tax_number)
            ->substr(0, 2)
            ->upper();
    }

    /**
     * @param string $tax_number
     * @param string $country
     * @return string
     */
    private function getFullTaxNumber(string $tax_number, string $country): string
    {
        $prefix = $this->getPrefix($tax_number);

        return Str::of($prefix)->startsWith($country)
            ? (string) Str::of($tax_number)
                ->substr(2)
                ->start($country)
            : (string) Str::of($tax_number)
                ->start($country);
    }

    /**
     * @param Collection $items
     * @return string
     */
    private function cleanupTaxNumber(Collection $items): string
    {
        return preg_replace_array(
            '/[^\d\w]/',
            [],
            $items->get($this->number_key)
        );
    }
}
