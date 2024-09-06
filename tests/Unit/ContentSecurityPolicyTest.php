<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\StrictPolicy;

test('Finds a policy in the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new StrictPolicy(Directive::ScriptSrc, []);
    $policy->add($newDirective);
    $foundDirective = $policy->find(Directive::ScriptSrc);

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
        new StrictPolicy(Directive::ScriptSrc, []),
        new StrictPolicy(Directive::ImgSrc, []),
        new StrictPolicy(Directive::ObjectSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $foundDirective = $policy->find(Directive::ImgSrc);

    expect($foundDirective->directiveName())->toBe(Directive::ImgSrc->value);
});

test('Adds a policy to the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new StrictPolicy(Directive::ScriptSrc, []);
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

    $newDirective1 = new StrictPolicy(Directive::ScriptSrc, []);
    $newDirective2 = new StrictPolicy(Directive::ImgSrc, []);
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
        new StrictPolicy(Directive::ScriptSrc, []),
        new StrictPolicy(Directive::ImgSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove(Directive::ScriptSrc);
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe(Directive::ImgSrc->value);
});

test('Removes a non-existing policy from the policy array', function () {
    $policyDirectives = [
        new StrictPolicy(Directive::ScriptSrc, []),
        new StrictPolicy(Directive::ImgSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove('non-existing-policy');
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(2)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe(Directive::ScriptSrc->value)
        ->and($directivesAfterRemove[1]->directiveName())
        ->toBe(Directive::ImgSrc->value);
});

test('Removes multiple policies from the policy array', function () {
    $policyDirectives = [
        new StrictPolicy(Directive::ScriptSrc, []),
        new StrictPolicy(Directive::ImgSrc, []),
        new StrictPolicy(Directive::ObjectSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy
        ->remove(Directive::ScriptSrc)
        ->remove(Directive::ObjectSrc);
    $directivesAfterRemove = $policy->policyDirectives();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directiveName())
        ->toBe(Directive::ImgSrc->value);
});
