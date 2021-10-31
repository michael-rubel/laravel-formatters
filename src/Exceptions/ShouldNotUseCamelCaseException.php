<?php

declare(strict_types=1);

namespace MichaelRubel\Formatters\Exceptions;

class ShouldNotUseCamelCaseException extends \Exception
{
    protected $message = 'The camel case is most probably will conflict with Laravel bindings.';
}
