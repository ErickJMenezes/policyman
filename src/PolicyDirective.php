<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

use ErickJMenezes\Policyman\Exceptions\UnknownDirectiveException;

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

    private const array ALLOWED_DIRECTIVES = [
        // Fetch directives
        'child-src',
        'connect-src',
        'default-src',
        'fenced-frame-src',
        'font-src',
        'frame-src',
        'img-src',
        'manifest-src',
        'media-src',
        'object-src',
        'prefetch-src',
        'script-src',
        'script-src',
        'script-src-attr',
        'style-src',
        'style-src-elem',
        'style-src-attr',
        'worker-src',
        // Document directives
        'base-uri',
        'sandbox',
        // Navigation directives
        'form-action',
        'frame-ancestors',
        // Reporting directives
        'report-to',
        // Other directives
        'require-trusted-types-for',
        'trusted-types',
        'upgrade-insecure-requests',
        // Deprecated directives
        'block-all-mixed-content',
        'report-uri',
    ];

    /**
     * @var non-empty-string $name
     */
    private string $name;

    /**
     * @var array<int, non-empty-string>
     */
    private array $constraints = [];

    /**
     * @param non-empty-string             $name
     * @param array<int, non-empty-string> $constraints
     */
    public function __construct(string $name, array $constraints)
    {
        $this->validateDirectiveName($name);
        $this->name = $name;
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
        $this->validateDirectiveName($newName);
        $this->name = $newName;
        return $this;
    }

    protected function validateDirectiveName(string $name): void
    {
        if (!in_array($name, self::ALLOWED_DIRECTIVES, true)) {
            throw new UnknownDirectiveException($name);
        }
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
