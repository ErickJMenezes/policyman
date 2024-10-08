<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\CSPParser;
use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\InvalidContentSecurityPolicyException;
use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Policy;

test('parseHeader method should return a ContentSecurityPolicy instance using string', function () {
    $header = "Content-Security-Policy: script-src 'self'";
    $cspParser = new CSPParser();
    $csp = $cspParser->parse($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find(Directive::ScriptSrc))
        ->toBeInstanceOf(Policy::class)
        ->and($csp->find(Directive::ScriptSrc)?->directive())
        ->toBe(Directive::ScriptSrc)
        ->and($csp->find(Directive::ScriptSrc)->constraints())
        ->toBeArray()
        ->toContain(Keyword::Self)
    ;
});

test('parseHeader method should remove Content-Security-Policy prefix', function () {
    $header = 'Content-Security-Policy: default-src \'self\'';
    $cspParser = new CSPParser();
    $csp = $cspParser->parse($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find(Directive::DefaultSrc))
        ->toBeInstanceOf(Policy::class)
        ->and($csp->find(Directive::DefaultSrc)?->directive())
        ->toBe(Directive::DefaultSrc);
});

test('parseHeader correctly handles CSP directives with multiple parts', function () {
    $header = "Content-Security-Policy: img-src 'self' data:; object-src 'none'";
    $cspParser = new CSPParser();
    $csp = $cspParser->parse($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find(Directive::ImgSrc))
        ->toBeInstanceOf(Policy::class)
        ->and($csp->find(Directive::ObjectSrc))
        ->toBeInstanceOf(Policy::class);
});

test('parseHeader correctly handles invalid csp headers', function () {
    $header = "Content";
    $cspParser = new CSPParser();
    expect(fn() => $cspParser->parse($header))
        ->toThrow(
            InvalidContentSecurityPolicyException::class,
            'Syntax error. Unexpected T_USER_DEFINED_KEYWORD at index 0. Check value "Content".',
        );
});

test('parseHeader fails to parse when invalid directive is present', function () {
    $header = "Content-Security-Policy: img-source 'self'";
    $cspParser = new CSPParser();

    expect(fn() => $cspParser->parse($header))
        ->toThrow(
            InvalidContentSecurityPolicyException::class,
            'Syntax error. Unexpected T_USER_DEFINED_KEYWORD at index 1. Check value "img-source".',
        );
});
