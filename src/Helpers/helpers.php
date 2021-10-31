<?php

declare(strict_types=1);

use MichaelRubel\Formatters\Exceptions\ShouldImplementInterfaceException;
use MichaelRubel\Formatters\Exceptions\ShouldNotUseCamelCaseException;
use MichaelRubel\Formatters\Formatter;
use MichaelRubel\Formatters\FormatterServiceProvider;

if (! function_exists('format')) {
    /**
     * @param string       $formatter
     * @param string|array $items
     *
     * @return mixed
     * @throws \Exception
     */
    function format(string $formatter, string|array $items): mixed
    {
        $formatter = class_exists($formatter) || interface_exists($formatter)
            ? app($formatter)
            : app($formatter . FormatterServiceProvider::BINDING_POSTFIX);

        if (! $formatter instanceof Formatter) {
            if (config('formatters.bindings_case') === 'camel') {
                throw new ShouldNotUseCamelCaseException();
            }

            throw new ShouldImplementInterfaceException();
        }

        /** @phpstan-ignore-next-line */
        return $formatter->format(
            collect($items)
        );
    }
}
