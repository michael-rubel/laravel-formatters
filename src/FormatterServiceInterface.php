<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters;

interface FormatterServiceInterface
{
    /**
     * Internal constants.
     *
     * @const
     */
    public const PACKAGE_KEY     = 'formatters';
    public const PACKAGE_FOLDER  = 'Collection';
    public const BINDING_POSTFIX = '_formatter';
    public const CLASS_SEPARATOR = '\\';
}
