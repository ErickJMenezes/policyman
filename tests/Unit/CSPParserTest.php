<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\CSPParser;
use ErickJMenezes\Policyman\LoosePolicyDirective;
use ErickJMenezes\Policyman\PolicyDirective;

test('parseHeader method should return a ContentSecurityPolicy instance using string', function () {
    $header = 'Content-Security-Policy: script-src \'self\'';
    $cspParser = new CSPParser();
    $csp = $cspParser->parseHeader($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find('script-src'))
        ->toBeInstanceOf(PolicyDirective::class)
        ->directiveName()
        ->toBe('script-src');
});

test('parseHeader method should remove Content-Security-Policy prefix', function () {
    $header = 'Content-Security-Policy: default-src \'self\'';
    $cspParser = new CSPParser();
    $csp = $cspParser->parseHeader($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find('default-src'))
        ->toBeInstanceOf(PolicyDirective::class)
        ->directiveName()
        ->toBe('default-src');
});

test('parseHeader correctly handles CSP directives with multiple parts', function () {
    $header = "Content-Security-Policy: img-src 'self' data:; object-src 'none'";
    $cspParser = new CSPParser();
    $csp = $cspParser->parseHeader($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->find('img-src'))
        ->toBeInstanceOf(PolicyDirective::class)
        ->and($csp->find('object-src'))
        ->toBeInstanceOf(PolicyDirective::class);
});

test('parseHeader correctly handles empty CSP headers', function () {
    $header = '';
    $cspParser = new CSPParser();
    $csp = $cspParser->parseHeader($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->policyDirectives())
        ->toBeArray()
        ->toBe([]);
});

test('parseHeader can parse invalid CSP directives', function () {
    $header = "Content-Security-Policy: img-source 'self'";
    $cspParser = new CSPParser();
    $csp = $cspParser->parseHeader($header, true);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->policyDirectives())
        ->toBeArray()
        ->toHaveCount(1)
        ->and($csp->find('img-source'))
        ->toBeInstanceOf(LoosePolicyDirective::class);
});
