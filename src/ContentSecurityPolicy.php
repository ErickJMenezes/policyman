<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Represents a Content Security Policy (CSP) which manages a list of policies.
 */
class ContentSecurityPolicy
{
    /**
     * @param array<int, PolicyDirective> $policyDirectives
     */
    public function __construct(private array $policyDirectives) {}

    /**
     * Adds a policy to the policy array.
     *
     * @param PolicyDirective $policyDirective The policy object to add.
     *
     * @return $this
     */
    public function add(PolicyDirective $policyDirective): self
    {
        $this->policyDirectives[] = $policyDirective;
        return $this;
    }

    /**
     * Searches for a policy directive by its name within the list of policy directives.
     *
     * @param non-empty-string $policyDirectiveName The name of the policy directive to find.
     *
     * @return PolicyDirective|null The found policy directive or null if not found.
     */
    public function find(string $policyDirectiveName): ?PolicyDirective
    {
        foreach ($this->policyDirectives as $policyDirective) {
            if ($policyDirective->directiveName() === $policyDirectiveName) {
                return $policyDirective;
            }
        }
        return null;
    }

    /**
     * @return PolicyDirective[]
     */
    public function policyDirectives(): array
    {
        return $this->policyDirectives;
    }

    /**
     * Removes a policy with the given name from the policy array and reindexes the remaining policies.
     *
     * @param non-empty-string $policyDirectiveName The name of the policy to remove.
     *
     * @return $this
     */
    public function remove(string $policyDirectiveName): self
    {
        $this->policyDirectives = array_filter(
            $this->policyDirectives,
            static fn(PolicyDirective $policyDirective): bool
                => $policyDirective->directiveName() !== $policyDirectiveName,
        );
        $this->reindexPolicies();
        return $this;
    }

    private function reindexPolicies(): void
    {
        $this->policyDirectives = array_values($this->policyDirectives);
    }
}
