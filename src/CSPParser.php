<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

use Closure;
use ValueError;

/**
 * A class that parses Content-Security-Policy (CSP) headers into an instance of ContentSecurityPolicy.
 */
class CSPParser
{
    /**
     * Parses a Content Security Policy header and creates a ContentSecurityPolicy object.
     *
     * @param string $header  The CSP header string to be parsed.
     *
     * @return ContentSecurityPolicy The parsed Content Security Policy object.
     * @throws ValueError If some header directive is not in {@see Directive} enum.
     */
    public function parseStrict(string $header): ContentSecurityPolicy
    {
        return $this->parseWith($header, $this->newStrictPolicy(...));
    }

    /**
     * Parses a Content Security Policy header and creates a ContentSecurityPolicy object without validating
     * the directives.
     *
     * @param string $header The CSP header string to be parsed.
     *
     * @return ContentSecurityPolicy The parsed Content Security Policy object.
     */
    public function parseLoose(string $header): ContentSecurityPolicy
    {
        return $this->parseWith($header, $this->newLoosePolicy(...));
    }

    /**
     * Parses a Content Security Policy header and creates a ContentSecurityPolicy object.
     *
     * @param string  $header             The CSP header string to be parsed.
     * @param Closure $newPolicyDirective The factory for new policy.
     *
     * @return ContentSecurityPolicy The parsed Content Security Policy object.
     */
    private function parseWith(string $header, Closure $newPolicyDirective): ContentSecurityPolicy
    {
        $header = $this->removeContentSecurityPolicyPrefix($header);

        $directives = [];
        $parts = explode(';', $header);

        foreach ($parts as $part) {
            if (empty($part)) {
                continue;
            }
            $directive = explode(' ', trim($part));
            $directives[] = $newPolicyDirective($directive);
        }

        return new ContentSecurityPolicy($directives);
    }

    /**
     * Removes the 'Content-Security-Policy:' prefix from the given header string.
     *
     * @param non-empty-string $header The header string that may contain the 'Content-Security-Policy:' prefix.
     *
     * @return non-empty-string The header string without the 'Content-Security-Policy:' prefix.
     */
    private function removeContentSecurityPolicyPrefix(string $header): string
    {
        return preg_replace('/^Content-Security-Policy:\s*/i', '', $header);
    }

    /**
     * @param array<int, string> $directive
     *
     * @return StrictPolicy
     * @throws ValueError If some header directive is not in {@see Directive} enum.
     */
    private function newStrictPolicy(array $directive): StrictPolicy
    {
        return new StrictPolicy(
            Directive::from($directive[0]),
            array_values(array_splice($directive, 1)),
        );
    }

    /**
     * @param array<int, string> $directive
     *
     * @return LoosePolicy
     */
    private function newLoosePolicy(array $directive): LoosePolicy
    {
        return new LoosePolicy(
            $directive[0],
            array_values(array_splice($directive, 1)),
        );
    }
}
