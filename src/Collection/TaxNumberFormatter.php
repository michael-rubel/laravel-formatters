<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Collection;

use Illuminate\Support\Str;
use MichaelRubel\Formatters\Formatter;

class TaxNumberFormatter implements Formatter
{
    /**
     * @param string|null $tax_number
     * @param string|null $country
     */
    public function __construct(
        public ?string $tax_number = null,
        public ?string $country = null
    ) {
        $this->cleanup();
    }

    /**
     * Format the Tax Number.
     *
     * @return string
     */
    public function format(): string
    {
        return ! blank($this->country)
            ? $this->getFullTaxNumber()
            : $this->tax_number ?? '';
    }

    /**
     * @return void
     */
    private function cleanup(): void
    {
        $regexedTaxNumber = preg_replace_array(
            '/[^\d\w]/',
            [],
            $this->tax_number
        );

        $this->tax_number = Str::upper($regexedTaxNumber);
        $this->country    = Str::upper($this->country);
    }

    /**
     * @return string
     */
    private function getPrefix(): string
    {
        return (string) Str::of($this->tax_number)
            ->substr(0, 2)
            ->upper();
    }

    /**
     * @return string
     */
    private function getFullTaxNumber(): string
    {
        $prefixStartsWithCountry = Str::of($this->getPrefix())
            ->startsWith($this->country);

        if ($prefixStartsWithCountry) {
            return (string) Str::of($this->tax_number)
                ->substr(2)
                ->start($this->country);
        }

        return Str::start($this->tax_number, $this->country);
    }
}
