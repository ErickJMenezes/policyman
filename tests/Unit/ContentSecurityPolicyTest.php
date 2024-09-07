<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\Directive;
use ErickJMenezes\Policyman\Policy;

test('Finds a policy in the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new Policy(Directive::ScriptSrc, []);
    $policy->add($newDirective);
    $foundDirective = $policy->find(Directive::ScriptSrc);

    expect($foundDirective)->toBe($newDirective);
});

test('Finds a non existing policy in the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $nonExistingDirective = $policy->find(Directive::BaseUri);

    expect($nonExistingDirective)->toBeNull();
});

test('Finds a policy in the policy array with multiple policies', function () {
    $policyDirectives = [
        new Policy(Directive::ScriptSrc, []),
        new Policy(Directive::ImgSrc, []),
        new Policy(Directive::ObjectSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $foundDirective = $policy->find(Directive::ImgSrc);

    expect($foundDirective->directive())->toBe(Directive::ImgSrc);
});

test('Adds a policy to the policy array', function () {
    $policyDirectives = [];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $newDirective = new Policy(Directive::ScriptSrc, []);
    $policy->add($newDirective);
    $directivesAfterAdd = $policy->policies();

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

    $newDirective1 = new Policy(Directive::ScriptSrc, []);
    $newDirective2 = new Policy(Directive::ImgSrc, []);
    $policy
        ->add($newDirective1)
        ->add($newDirective2);
    $directivesAfterAdd = $policy->policies();

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
        new Policy(Directive::ScriptSrc, []),
        new Policy(Directive::ImgSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove(Directive::ScriptSrc);
    $directivesAfterRemove = $policy->policies();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directive())
        ->toBe(Directive::ImgSrc);
});

test('Removes a non-existing policy from the policy array', function () {
    $policyDirectives = [
        new Policy(Directive::ScriptSrc, []),
        new Policy(Directive::ImgSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy->remove(Directive::DefaultSrc);
    $directivesAfterRemove = $policy->policies();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(2)
        ->and($directivesAfterRemove[0]->directive())
        ->toBe(Directive::ScriptSrc)
        ->and($directivesAfterRemove[1]->directive())
        ->toBe(Directive::ImgSrc);
});

test('Removes multiple policies from the policy array', function () {
    $policyDirectives = [
        new Policy(Directive::ScriptSrc, []),
        new Policy(Directive::ImgSrc, []),
        new Policy(Directive::ObjectSrc, []),
    ];
    $policy = new ContentSecurityPolicy($policyDirectives);

    $policy
        ->remove(Directive::ScriptSrc)
        ->remove(Directive::ObjectSrc);
    $directivesAfterRemove = $policy->policies();

    expect($directivesAfterRemove)
        ->toBeArray()
        ->and($directivesAfterRemove)
        ->toHaveCount(1)
        ->and($directivesAfterRemove[0]->directive())
        ->toBe(Directive::ImgSrc);
});
