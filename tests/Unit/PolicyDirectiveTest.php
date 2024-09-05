<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\PolicyDirective;

test('can add a constraint', function () {
    $policy = new PolicyDirective('default', []);
    $policy->add('self');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe("'self'"),
        );
});

test('can add a non-keyword constraint', function () {
    $policy = new PolicyDirective('default', []);
    $policy->add('constraint');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe('constraint'),
        );
});

test('can remove a keyword constraint', function () {
    $policy = new PolicyDirective('default', ["'self'"]);
    $policy->remove('self');

    expect($policy->constraints())
        ->toBeEmpty();
});

test('can remove a non-keyword constraint', function () {
    $policy = new PolicyDirective('default', ['constraint']);
    $policy->remove('constraint');

    expect($policy->constraints())
        ->toBeEmpty();
});

test('remove method does nothing when the constraint does not exist', function () {
    $policy = new PolicyDirective('default', ["'self'"]);
    $policy->remove('nonexistent');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe("'self'"),
        );
});

test('can rename the directive', function () {
    $policy = new PolicyDirective('default', []);
    $policy->rename('newName');

    expect($policy->directiveName())
        ->toBe('newName');
});
