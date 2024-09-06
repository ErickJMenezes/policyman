<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Class CSPSerializer
 *
 * Handles the serialization of Content-Security-Policy directives into a format
 * suitable for use in HTTP headers.
 */
class CSPSerializer
{
    /**
     * Serializes a ContentSecurityPolicy object into a string format suitable for use
     * in HTTP headers.
     *
     * @param ContentSecurityPolicy|Policy[] $policies The policies to serialize.
     *
     * @return non-empty-string The serialized Content-Security-Policy header string.
     */
    public function serialize(array|ContentSecurityPolicy $policies): string
    {
        $items = $policies instanceof ContentSecurityPolicy ? $policies->policies() : $policies;
        $stringPolicies = $this->transformPolicyDirectivesToSerializedFormat($items);
        return 'Content-Security-Policy: '.implode('; ', $stringPolicies);
    }

    /**
     * @param Policy[] $policies
     *
     * @return array<int, non-empty-string>
     */
    private function transformPolicyDirectivesToSerializedFormat(array $policies): array
    {
        return array_map($this->serializePolicyDirective(...), $policies);
    }

    /**
     * @return non-empty-string
     */
    private function serializePolicyDirective(Policy $policy): string
    {
        $constraints = implode(
            ' ',
            array_map(
                fn(Keyword|string $constraint): string
                    => is_string($constraint) ? $constraint : $constraint->escaped(),
                $policy->constraints(),
            ),
        );
        return trim("{$policy->directive()->value} {$constraints}");
    }
}
