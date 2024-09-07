<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

use ErickJMenezes\PolicymanParser\Parser;

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
     * @throws InvalidContentSecurityPolicyException If the header could not be parsed.
     */
    public function parse(string $header): ContentSecurityPolicy
    {
        $lexer = new CSPLexer($header);
        $parser = new Parser($lexer);
        $success = $parser->parse();
        if (!$success) {
            throw new InvalidContentSecurityPolicyException(
                $header,
                implode(' ', $lexer->getErrorMessages()),
            );
        }
        return $parser->getCsp();
    }
}
