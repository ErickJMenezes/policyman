# Policyman 👮

A Content Security Policy parser and builder.

## Instalation
```shell
composer install erickjmenezes/policyman
```

## Building a CSP header:
```php
use ErickJMenezes\Policyman\Policyman;

$header = Policyman::builder()
    ->defaultSrc([Keyword::Self])
    ->scriptSrc([Keyword::Self, Keyword::UnsafeEval, Keyword::UnsafeInline, 'trusted-cdn.com'])
    ->styleSrc([Keyword::Self, 'trusted-cdn.com'])
    ->toString();

// Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' trusted-cdn.com; style-src 'self' trusted-cdn.com
```

## Parsing and editing an existing CSP header string:
```php
use ErickJMenezes\Policyman\Policyman;
use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\Policy;
use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Directive;

// Example header.
$header = "Content-Security-Policy: img-src 'self' data:; object-src 'none'";

// Parsing to an object.
/** @var ContentSecurityPolicy $csp */
$csp = Policyman::parse($header);

// Adding script-src directive.
$csp->add(new Policy(Directive::ScriptSrc, [Keyword::Self, 'example.com']));
$csp->find(Directive::ImgSrc)->add('example.com');

// Convert it back to a string.
$newHeader = Policyman::serialize($csp);

// Content-Security-Policy: img-src 'self' data: example.com; object-src 'none'; script-src 'self' example.com
```
