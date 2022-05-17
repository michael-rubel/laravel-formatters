<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters;

use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Exceptions\ShouldNotUseCamelCaseException;

class FormatterService
{
    /**
     * Ensures all the formatters will implement the same interface.
     *
     * @param object $formatter
     */
    public static function ensureFormatterImplementsInterface(object $formatter): void
    {
        if (! $formatter instanceof Formatter) {
            if (config('formatters.bindings_case') === 'camel') {
                throw new ShouldNotUseCamelCaseException();
            }

            throw new ShouldImplementInterfaceException();
        }
    }

    /**
     * Unwrap the array if it is only one passed parameter.
     *
     * @param mixed $items
     *
     * @return mixed
     */
    public static function unwrapIfArray(mixed $items): mixed
    {
        $first = current($items);

        if (is_array($first) && count($items) === 1) {
            return $first;
        }

        return $items;
    }
}