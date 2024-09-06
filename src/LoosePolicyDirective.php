<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Class LoosePolicyDirective
 *
 * A subclass of PolicyDirective that represents a policy directive with loose validation rules.
 */
class LoosePolicyDirective extends PolicyDirective
{
    protected function validateDirectiveName(string $name): void
    {
        // Do nothing.
    }
}

