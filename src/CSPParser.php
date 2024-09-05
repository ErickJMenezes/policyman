<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

class CSPParser
{
    /**
     * Parses the given CSP header string and returns a ContentSecurityPolicy instance.
     *
     * @param string $header
     *
     * @return ContentSecurityPolicy
     */
    public function parseHeader(string $header): ContentSecurityPolicy
    {
        $header = $this->removeContentSecurityPolicyPrefix($header);

        $directives = [];
        $parts = explode(';', $header);

        foreach ($parts as $part) {
            if (empty($part)) {
                continue;
            }
            $directive = explode(' ', trim($part));
            $directives[] = new PolicyDirective(
                $directive[0],
                array_values(array_splice($directive, 1)),
            );
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
}
