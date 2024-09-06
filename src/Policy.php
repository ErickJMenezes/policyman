<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Class Policy
 *
 * It initializes the directive name and its associated constraints.
 */
class Policy
{
    /**
     * @var Directive $directive
     */
    private Directive $directive;

    /**
     * @var array<int, non-empty-string>
     */
    private array $constraints = [];

    /**
     * @param Directive                            $directive
     * @param array<int, non-empty-string|Keyword> $constraints
     */
    public function __construct(Directive $directive, array $constraints)
    {
        $this->directive = $directive;
        foreach ($constraints as $constraint) {
            $this->add($constraint);
        }
    }

    /**
     * @param non-empty-string|Keyword $constraint
     *
     * @return $this
     */
    public function add(string|Keyword $constraint): self
    {
        $this->constraints[] = $this->wrapConstraint($constraint);
        return $this;
    }

    private function wrapConstraint(string|Keyword $constraint): Keyword|string
    {
        $kw = $constraint instanceof Keyword
            ? $constraint
            : Keyword::tryFrom(trim($constraint, "'\""));
        return $kw ?? $constraint;
    }

    public function directive(): Directive
    {
        return $this->directive;
    }

    /**
     * @param non-empty-string|Keyword $constraint
     *
     * @return $this
     */
    public function remove(string|Keyword $constraint): self
    {
        $wrappedConstraint = $this->wrapConstraint($constraint);
        $constraintKey = array_search($wrappedConstraint, $this->constraints, true);
        if ($constraintKey !== false) {
            unset($this->constraints[$constraintKey]);
            $this->reindexConstraints();
        }
        return $this;
    }

    private function reindexConstraints(): void
    {
        $this->constraints = array_values($this->constraints);
    }

    /**
     * @return array<int, Keyword|non-empty-string>
     */
    public function constraints(): array
    {
        return $this->constraints;
    }
}
