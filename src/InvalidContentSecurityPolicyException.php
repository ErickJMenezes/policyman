<?php

declare(strict_types=1);

namespace ErickJMenezes\Policyman;

use Exception;

/**
 * Exception thrown when an invalid Content Security Policy (CSP) is encountered.
 *
 * Indicates that the Content Security Policy either does not conform to the expected format
 * or includes directives that are not supported or recognized by the application.
 */
class InvalidContentSecurityPolicyException extends Exception
{
    public readonly string $invalidContentSecurityPolicy;

    public function __construct(
        string $invalidContentSecurityPolicy,
        string $message,
    )
    {
        $this->invalidContentSecurityPolicy = $invalidContentSecurityPolicy;
        parent::__construct("The given content security policy header, could not be parsed. $message");
    }
}
