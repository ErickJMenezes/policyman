<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Represents a Content Security Policy (CSP) which manages a list of policies.
 */
class ContentSecurityPolicy
{
    /**
     * @param array<int, Policy> $policies
     */
    public function __construct(private array $policies) {}

    /**
     * Adds a policy to the policy array.
     *
     * @param Policy $policy The policy object to add.
     *
     * @return $this
     */
    public function add(Policy $policy): self
    {
        $this->policies[] = $policy;
        return $this;
    }

    /**
     * Searches for a policy directive by its name within the list of policy directives.
     *
     * @param Directive $directive The name of the policy directive to find.
     *
     * @return Policy|null The found policy directive or null if not found.
     */
    public function find(Directive $directive): ?Policy
    {
        foreach ($this->policies as $policy) {
            if ($policy->directive() === $directive) {
                return $policy;
            }
        }
        return null;
    }

    /**
     * @return Policy[]
     */
    public function policies(): array
    {
        return $this->policies;
    }

    /**
     * Removes a policy with the given name from the policy array and reindexes the remaining policies.
     *
     * @param Directive $directive The name of the policy to remove.
     *
     * @return $this
     */
    public function remove(Directive $directive): self
    {
        $this->policies = array_filter(
            $this->policies,
            static fn(Policy $policy): bool
                => $policy->directive() !== $directive,
        );
        $this->reindexPolicies();
        return $this;
    }

    private function reindexPolicies(): void
    {
        $this->policies = array_values($this->policies);
    }
}
