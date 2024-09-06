<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

class PolicyDirective
{
    private const array KEYWORDS = [
        'self',
        'none',
        'strict-dynamic',
        'report-sample',
        'inline-speculation-rules',
        'unsafe-inline',
        'unsafe-eval',
        'unsafe-hashes',
        'wasm-unsafe-eval',
    ];

    /**
     * @var array<int, non-empty-string>
     */
    private array $constraints = [];

    /**
     * @param non-empty-string             $name
     * @param array<int, non-empty-string> $constraints
     */
    public function __construct(
        private string $name,
        array $constraints,
    ) {
        foreach ($constraints as $constraint) {
            $this->add($constraint);
        }
    }

    /**
     * @return non-empty-string
     */
    public function directiveName(): string
    {
        return $this->name;
    }

    /**
     * @param non-empty-string $newName
     *
     * @return $this
     */
    public function rename(string $newName): self
    {
        $this->name = $newName;
        return $this;
    }

    /**
     * @param non-empty-string $constraint
     *
     * @return $this
     */
    public function add(string $constraint): self
    {
        $this->constraints[] = $this->wrapConstraint($constraint);
        return $this;
    }

    private function wrapConstraint(string $constraint): string
    {
        if (in_array($constraint, self::KEYWORDS, true)) {
            return "'{$constraint}'";
        }
        return $constraint;
    }

    /**
     * @param non-empty-string $constraint
     *
     * @return $this
     */
    public function remove(string $constraint): self
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
