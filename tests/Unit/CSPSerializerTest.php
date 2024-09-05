<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\CSPSerializer;
use ErickJMenezes\Policyman\PolicyDirective;

test('it correctly serializes PolicyDirective', function () {
    $cspSerializer = new CSPSerializer();

    // create policies
    $policies = [];
    $directive1 = new PolicyDirective('default-src', ['self']);
    $policies[] = $directive1;

    $directive2 = new PolicyDirective('script-src', ['self', 'static.example.com']);
    $policies[] = $directive2;

    $result = $cspSerializer->serialize($policies);
    $expected = 'Content-Security-Policy: default-src self; script-src self static.example.com';

    expect($result)->toBe($expected);
});

test('it correctly serializes empty PolicyDirective', function () {
    $cspSerializer = new CSPSerializer();

    // create policies
    $policies = [];
    $directive1 = new PolicyDirective('default-src', []);
    $policies[] = $directive1;

    $result = $cspSerializer->serialize($policies);
    $expected = 'Content-Security-Policy: default-src';

    expect($result)->toBe($expected);
});
