<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Policy;
use ErickJMenezes\Policyman\Directive;

test('can add a constraint', function () {
    $policy = new Policy(Directive::DefaultSrc, []);
    $policy->add("'self'")
        ->add(Keyword::ReportSample);

    expect($policy->constraints())
        ->toHaveCount(2)
        ->sequence(
            fn($e) => $e->toBe(Keyword::Self),
            fn($e) => $e->toBe(Keyword::ReportSample),
        );
});

test('can add a non-keyword constraint', function () {
    $policy = new Policy(Directive::DefaultSrc, []);
    $policy->add('constraint');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe('constraint'),
        );
});

test('can remove a keyword constraint', function () {
    $policy = new Policy(Directive::DefaultSrc, ["'self'"]);
    $policy->remove("'self'");

    expect($policy->constraints())
        ->toBeEmpty();
});

test('can remove a non-keyword constraint', function () {
    $policy = new Policy(Directive::DefaultSrc, ['constraint']);
    $policy->remove('constraint');

    expect($policy->constraints())
        ->toBeEmpty();
});

test('remove method does nothing when the constraint does not exist', function () {
    $policy = new Policy(Directive::DefaultSrc, ["'self'"]);
    $policy->remove('nonexistent');

    expect($policy->constraints())
        ->toHaveCount(1)
        ->sequence(
            fn($e) => $e->toBe(Keyword::Self),
        );
});
