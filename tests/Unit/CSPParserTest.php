<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\CSPParser;
use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Policy;
use ValueError;

test('parseHeader method should return a ContentSecurityPolicy instance using string', function () {
    $header = 'Content-Security-Policy: script-src \'self\'';
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
        ->not->toBeEmpty()
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

test('parseHeader correctly handles empty CSP headers', function () {
    $header = '';
    $cspParser = new CSPParser();
    $csp = $cspParser->parse($header);

    expect($csp)
        ->toBeInstanceOf(ContentSecurityPolicy::class)
        ->and($csp->policies())
        ->toBeArray()
        ->toBe([]);
});

test('parseHeader fails to parse when invalid directive is present', function () {
    $header = "Content-Security-Policy: img-source 'self'";
    $cspParser = new CSPParser();

    expect(fn() => $cspParser->parse($header))
        ->toThrow(
            ValueError::class,
            'img-source" is not a valid backing value for enum ErickJMenezes\Policyman\Directive',
        );
});
