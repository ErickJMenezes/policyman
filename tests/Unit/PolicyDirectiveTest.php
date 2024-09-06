<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\Exceptions\UnknownDirectiveException;
use ErickJMenezes\Policyman\PolicyDirective;

test('can add a constraint', function () {
    $policy = new PolicyDirective('default-src', []);
    $policy->add('self');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe("'self'"),
        );
});

test('can add a non-keyword constraint', function () {
    $policy = new PolicyDirective('default-src', []);
    $policy->add('constraint');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe('constraint'),
        );
});

test('can remove a keyword constraint', function () {
    $policy = new PolicyDirective('default-src', ["'self'"]);
    $policy->remove('self');

    expect($policy->constraints())
        ->toBeEmpty();
});

test('can remove a non-keyword constraint', function () {
    $policy = new PolicyDirective('default-src', ['constraint']);
    $policy->remove('constraint');

    expect($policy->constraints())
        ->toBeEmpty();
});

test('remove method does nothing when the constraint does not exist', function () {
    $policy = new PolicyDirective('default-src', ["'self'"]);
    $policy->remove('nonexistent');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe("'self'"),
        );
});

test('can rename the directive', function () {
    $policy = new PolicyDirective('default-src', []);
    $policy->rename('object-src');

    expect($policy->directiveName())
        ->toBe('object-src');
});

test('invalid directive name must throw an exception', function () {
    expect(static fn() => new PolicyDirective('default-source', []))
        ->toThrow(
            UnknownDirectiveException::class,
            'The directive [default-source] does not exist. And is not supported by browsers.',
        );
});
