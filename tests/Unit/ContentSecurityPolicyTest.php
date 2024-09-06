<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\PolicyDirective;

test('Finds a policy in the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new PolicyDirective('script-src', []);
    $policy->add($newDirective);
    $foundDirective = $policy->find('script-src');

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
        new PolicyDirective('script-src', []),
        new PolicyDirective('img-src', []),
        new PolicyDirective('object-src', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $foundDirective = $policy->find('img-src');

    expect($foundDirective->directiveName())->toBe('img-src');
});

test('Adds a policy to the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new PolicyDirective('script-src', []);
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

    $newDirective1 = new PolicyDirective('script-src', []);
    $newDirective2 = new PolicyDirective('img-src', []);
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
        new PolicyDirective('script-src', []),
        new PolicyDirective('img-src', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove('script-src');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe('img-src');
});

test('Removes a non-existing policy from the policy array', function () {
    $policyDirectives = [
        new PolicyDirective('script-src', []),
        new PolicyDirective('img-src', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove('non-existing-policy');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(2)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe('script-src')
        ->and($directivesAfterRemove[1]->directiveName())
        ->toBe('img-src');
});

test('Removes multiple policies from the policy array', function () {
    $policyDirectives = [
        new PolicyDirective('script-src', []),
        new PolicyDirective('img-src', []),
        new PolicyDirective('object-src', []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy
        ->remove('script-src')
        ->remove('object-src');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe('img-src');
});
