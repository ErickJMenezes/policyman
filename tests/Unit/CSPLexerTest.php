<?php

namespace Tests\Unit;

use ErickJMenezes\Policyman\CSPLexer;
use Pest\Expectation;

/**
 * @param string $subject
 * @return array<int, array<int, string>>
 */
function lex(string $subject): array
{
    $lexer = new CSPLexer($subject);
    $values = [];
    do {
        $token = $lexer->yylex();
        $value = $lexer->getLVal();
        if ($token !== CSPLexer::YYEOF) {
            $values[] = [$token, $value];
        }
    } while ($token !== CSPLexer::YYEOF);
    return $values;
}

test('it lexes the value', function () {
    $subject = "Content-Security-Policy: script-src 'self'";
    $result = lex($subject);
    expect($result)
        ->toHaveCount(3)
        ->sequence(
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_CSP, 'Content-Security-Policy:'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_SCRIPT_SRC, 'script-src'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_SELF, "'self'"),
        );
});

test('must lex the given content security policy', function () {
    $subject = "Content-Security-Policy: default-src 'self'; img-src https://*; child-src 'none';";

    $result = lex($subject);

    expect($result)
        ->toHaveCount(10)
        ->sequence(
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_CSP, 'Content-Security-Policy:'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_DEFAULT_SRC, 'default-src'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_SELF, "'self'"),
            fn(Expectation $item) => $item->toContainEqual(ord(';'), ';'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_IMG_SRC, 'img-src'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_USER_DEFINED_KEYWORD, 'https://*'),
            fn(Expectation $item) => $item->toContainEqual(ord(';'), ';'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_CHILD_SRC, 'child-src'),
            fn(Expectation $item) => $item->toContainEqual(CSPLexer::T_NONE, "'none'"),
            fn(Expectation $item) => $item->toContainEqual(ord(';'), ';'),
        );
});
