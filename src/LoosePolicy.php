<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Class LoosePolicyDirective
 *
 * A subclass of PolicyDirective that represents a policy directive with loose validation rules.
 */
final class LoosePolicy extends Policy
{
    public function __construct(string|Directive $name, array $constraints)
    {
        parent::__construct(
            $name instanceof Directive ? $name->value : $name,
            $constraints,
        );
    }
}

