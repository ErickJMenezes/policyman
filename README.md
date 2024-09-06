# Policyman 👮

A simple interface to manage your CSP header.

## Instalation
```shell
composer install erickjmenezes/policyman
```

## How to use
Let's jump into a simple use-case: We want to edit an existing CSP header to add some new content to it.
```php
use ErickJMenezes\Policyman\CSPParser;
use ErickJMenezes\Policyman\CSPSerializer;
use ErickJMenezes\Policyman\ContentSecurityPolicy;
use ErickJMenezes\Policyman\PolicyDirective;

// Our example CSP header:
$header = "Content-Security-Policy: img-src 'self' data:; object-src 'none'";

// Let's parse and edit this header to add more security policies.
/** @var ContentSecurityPolicy $csp */
$csp = (new CSPParser())->parseHeader($header);

// Now we can add/edit/remove everything in the header.
$csp->add(new PolicyDirective('media-src', ['self', 'example.com']));
$csp->find('img-src')->add('example.com');

// Let's serialize it to a string.
$newHeader = (new CSPSerializer())->serialize($csp);

// Send it to the browser.
header($newHeader);
```
