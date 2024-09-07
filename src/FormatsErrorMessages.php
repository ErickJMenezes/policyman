<?php

declare(strict_types=1);

namespace ErickJMenezes\Policyman;

use ErickJMenezes\PolicymanParser\Context;

/**
 * Trait FormatsErrorMessages
 *
 * Provides functionality to format error messages based on the context.
 */
trait FormatsErrorMessages
{
    private function buildErrorMessage(Context $context): string
    {
        return "Syntax error. Unexpected {$context->getToken()->getName()}";
    }
}
