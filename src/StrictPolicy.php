<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Class StrictPolicy
 *
 * Handles the creation of a policy directive by extending the base Policy class.
 * It initializes the directive name and its associated constraints.
 * It has strong validation rules, compared to the LoosePolicyDirective.
 */
final class StrictPolicy extends Policy
{
}
