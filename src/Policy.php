<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

abstract class Policy
{
    /**
     * @var non-empty-string $name
     */
    private string $name;

    /**
     * @var array<int, non-empty-string>
     */
    private array $constraints = [];

    /**
     * @param non-empty-string                     $name
     * @param array<int, non-empty-string|Keyword> $constraints
     */
    public function __construct(string $name, array $constraints)
    {
        $this->name = $name;
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

    private function wrapConstraint(string|Keyword $constraint): string
    {
        $kw = $constraint instanceof Keyword
            ? $constraint
            : Keyword::tryFrom($constraint);
        return $kw?->escaped() ?? $constraint;
    }

    /**
     * @return non-empty-string
     */
    public function directiveName(): string
    {
        return $this->name;
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
     * @return array<int, non-empty-string>
     */
    public function constraints(): array
    {
        return $this->constraints;
    }
}
