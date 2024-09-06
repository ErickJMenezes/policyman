<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\CSPParser;
use ErickJMenezes\Policyman\LoosePolicy;
use ErickJMenezes\Policyman\StrictPolicy;
use ValueError;

test('parseHeader method should return a ContentSecurityPolicy instance using string', function () {
    $header = 'Content-Security-Policy: script-src \'self\'';
    $cspParser = new CSPParser();
    $csp = $cspParser->parseStrict($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find('script-src'))
        ->toBeInstanceOf(StrictPolicy::class)
        ->and($csp->find('script-src')?->directiveName())
        ->toBe('script-src');
});

test('parseHeader method should remove Content-Security-Policy prefix', function () {
    $header = 'Content-Security-Policy: default-src \'self\'';
    $cspParser = new CSPParser();
    $csp = $cspParser->parseStrict($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find('default-src'))
        ->toBeInstanceOf(StrictPolicy::class)
        ->and($csp->find('default-src')?->directiveName())
        ->toBe('default-src');
});

test('parseHeader correctly handles CSP directives with multiple parts', function () {
    $header = "Content-Security-Policy: img-src 'self' data:; object-src 'none'";
    $cspParser = new CSPParser();
    $csp = $cspParser->parseStrict($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find('img-src'))
        ->toBeInstanceOf(StrictPolicy::class)
        ->and($csp->find('object-src'))
        ->toBeInstanceOf(StrictPolicy::class);
});

test('parseHeader correctly handles empty CSP headers', function () {
    $header = '';
    $cspParser = new CSPParser();
    $csp = $cspParser->parseStrict($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->policyDirectives())
        ->toBeArray()
        ->toBe([]);
});

test('parseHeader can parse invalid CSP directives when set to loosely', function () {
    $header = "Content-Security-Policy: img-source 'self'";
    $cspParser = new CSPParser();
    $csp = $cspParser->parseLoose($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->policyDirectives())
        ->toBeArray()
        ->toHaveCount(1)
        ->and($csp->find('img-source'))
        ->toBeInstanceOf(LoosePolicy::class);
});

test('parseHeader fails to parse when invalid directive is present', function () {
    $header = "Content-Security-Policy: img-source 'self'";
    $cspParser = new CSPParser();

    expect(fn() => $cspParser->parseStrict($header))
        ->toThrow(
            ValueError::class,
            'img-source" is not a valid backing value for enum ErickJMenezes\Policyman\Directive',
        );
});
