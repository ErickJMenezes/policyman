<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * A class that parses Content-Security-Policy (CSP) headers into an instance of ContentSecurityPolicy.
 */
class CSPParser
{
    /**
     * Parses a Content Security Policy header and creates a ContentSecurityPolicy object.
     *
     * @param string $header  The CSP header string to be parsed.
     * @param bool   $loosely If true, the header will be parsed using loose rules.
     *
     * @return ContentSecurityPolicy The parsed Content Security Policy object.
     */
    public function parseHeader(string $header, bool $loosely = false): ContentSecurityPolicy
    {
        $newPolicyDirective = $loosely ? $this->newLoosePolicyDirective(...) : $this->newPolicyDirective(...);
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
     * @return PolicyDirective
     */
    private function newPolicyDirective(array $directive): PolicyDirective
    {
        return new PolicyDirective(
            $directive[0],
            array_values(array_splice($directive, 1)),
        );
    }

    /**
     * @param array<int, string> $directive
     *
     * @return LoosePolicyDirective
     */
    private function newLoosePolicyDirective(array $directive): LoosePolicyDirective
    {
        return new LoosePolicyDirective(
            $directive[0],
            array_values(array_splice($directive, 1)),
        );
    }
}
