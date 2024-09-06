<?php

declare(strict_types=1);

namespace ErickJMenezes\Policyman\Exceptions;

use InvalidArgumentException;
use Throwable;

class UnknownDirectiveException extends InvalidArgumentException
{
    public function __construct(string $directiveName, Throwable $previous = null)
    {
        parent::__construct(
            "The directive [$directiveName] does not exist. And is not supported by browsers.",
            1000,
            $previous,
        );
    }
}
