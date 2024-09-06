<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\CSPSerializer;
use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\Policy;

test('it correctly serializes PolicyDirective', function () {
    $cspSerializer = new CSPSerializer();

    // create policies
    $policies = [];
    $directive1 = new Policy(Directive::DefaultSrc, ['self']);
    $policies[] = $directive1;

    $directive2 = new Policy(Directive::ScriptSrc, ['self', 'static.example.com']);
    $policies[] = $directive2;

    $result = $cspSerializer->serialize($policies);
    $expected = "Content-Security-Policy: default-src 'self'; script-src 'self' static.example.com";

    expect($result)->toBe($expected);
});

test('it correctly serializes empty PolicyDirective', function () {
    $cspSerializer = new CSPSerializer();

    // create policies
    $policies = [];
    $directive1 = new Policy(Directive::DefaultSrc, []);
    $policies[] = $directive1;

    $result = $cspSerializer->serialize($policies);
    $expected = 'Content-Security-Policy: default-src';

    expect($result)->toBe($expected);
});

test('it correctly serializes a CSP object', function () {
    $cspSerializer = new CSPSerializer();

    // create policies
    $policies = [];
    $directive1 = new Policy(Directive::DefaultSrc, []);
    $policies[] = $directive1;

    $result = $cspSerializer->serialize(new ContentSecurityPolicy($policies));
    $expected = 'Content-Security-Policy: default-src';

    expect($result)->toBe($expected);
});
