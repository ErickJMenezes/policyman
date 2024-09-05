<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\PolicyDirective;

test('Finds a policy in the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new PolicyDirective('policy-1', []);
    $policy->add($newDirective);
    $foundDirective = $policy->find('policy-1');

    expect($foundDirective)->toBe($newDirective);
});

test('Finds a non existing policy in the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $nonExistingDirective = $policy->find('non-existing-policy');

    expect($nonExistingDirective)->toBeNull();
});

test('Finds a policy in the policy array with multiple policies', function () {
    $policyDirectives = [
        new PolicyDirective('policy-1', []),
        new PolicyDirective('policy-2', []),
        new PolicyDirective('policy-3', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $foundDirective = $policy->find('policy-2');

    expect($foundDirective->directiveName())->toBe('policy-2');
});

test('Adds a policy to the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new PolicyDirective('policy-1', []);
    $policy->add($newDirective);
    $directivesAfterAdd = $policy->policyDirectives();

    expect($directivesAfterAdd)
        ->toBeArray()
        ->and($directivesAfterAdd)
        ->toHaveCount(1)
        ->and($directivesAfterAdd[0])
        ->toBe($newDirective);
});

test('Adds multiple policies to the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective1 = new PolicyDirective('policy-1', []);
    $newDirective2 = new PolicyDirective('policy-2', []);
    $policy
        ->add($newDirective1)
        ->add($newDirective2);
    $directivesAfterAdd = $policy->policyDirectives();

    expect($directivesAfterAdd)
        ->toBeArray()
        ->and($directivesAfterAdd)
        ->toHaveCount(2)
        ->and($directivesAfterAdd[0])
        ->toBe($newDirective1)
        ->and($directivesAfterAdd[1])
        ->toBe($newDirective2);
});
test('Removes a policy from the policy array', function () {
    $policyDirectives = [
        new PolicyDirective('policy-1', []),
        new PolicyDirective('policy-2', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove('policy-1');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe('policy-2');
});

test('Removes a non-existing policy from the policy array', function () {
    $policyDirectives = [
        new PolicyDirective('policy-1', []),
        new PolicyDirective('policy-2', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove('non-existing-policy');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(2)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe('policy-1')
        ->and($directivesAfterRemove[1]->directiveName())
        ->toBe('policy-2');
});

test('Removes multiple policies from the policy array', function () {
    $policyDirectives = [
        new PolicyDirective('policy-1', []),
        new PolicyDirective('policy-2', []),
        new PolicyDirective('policy-3', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy
        ->remove('policy-1')
        ->remove('policy-3');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe('policy-2');
});
