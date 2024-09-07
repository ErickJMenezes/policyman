<?php

declare(strict_types = 1);

namespace ErickJMenezes\Policyman;

/**
 * Class Policyman
 *
 * Provides methods to build, serialize, validate, and parse Content-Security-Policy (CSP) headers.
 */
final class Policyman
{
    /**
     * Instantiates and returns a new Content-Security-Policy (CSP) header builder object.
     *
     * @return CSPBuilder The newly created instance of CSPBuilder.
     */
    public static function builder(): CSPBuilder
    {
        return new CSPBuilder();
    }

    /**
     * Serializes the given ContentSecurityPolicy object into a string format.
     *
     * @param ContentSecurityPolicy $policy The content security policy object to serialize.
     *
     * @return string The serialized Content-Security-Policy (CSP) header as a string.
     */
    public static function serialize(ContentSecurityPolicy $policy): string
    {
        return (new CSPSerializer())->serialize($policy);
    }

    /**
     * Validates the given Content-Security-Policy (CSP) grammar.
     *
     * @param string $header The Content-Security-Policy (CSP) header to validate.
     *
     * @return bool True if the header is grammatically valid, false otherwise.
     */
    public static function validate(string $header): bool
    {
        try {
            self::parse($header);
            return true;
        } catch (InvalidContentSecurityPolicyException) {
            return false;
        }
    }

    /**
     * Parses the provided Content-Security-Policy (CSP) header string into a
     * ContentSecurityPolicy object.
     *
     * @param string $header The raw CSP header string to parse.
     *
     * @return ContentSecurityPolicy The parsed ContentSecurityPolicy object.
     * @throws InvalidContentSecurityPolicyException If the header could not be parsed.
     */
    public static function parse(string $header): ContentSecurityPolicy
    {
        return (new CSPParser())->parse($header);
    }
}
