<?php

use ErickJMenezes\Policyman\CSPBuilder;

test('it adds policies to the header', function (string $method, string $source, string $directive) {
   $builder = new CSPBuilder();
   $builder->$method([$source]);
   expect((string) $builder)->toBe("Content-Security-Policy: $directive $source");
})->with([
    ['childSrc', 'example.com', 'child-src'],
    ['connectSrc', 'example.com', 'connect-src'],
    ['defaultSrc', 'example.com', 'default-src'],
    ['fencedFrameSrc', 'example.com', 'fenced-frame-src'],
    ['fontSrc', 'example.com', 'font-src'],
    ['frameSrc', 'example.com', 'frame-src'],
    ['imgSrc', 'example.com', 'img-src'],
    ['manifestSrc', 'example.com', 'manifest-src'],
    ['mediaSrc', 'example.com', 'media-src'],
    ['objectSrc', 'example.com', 'object-src'],
    ['prefetchSrc', 'example.com', 'prefetch-src'],
    ['scriptSrc', 'example.com', 'script-src'],
    ['scriptSrcAttr', 'example.com', 'script-src-attr'],
    ['styleSrc', 'example.com', 'style-src'],
    ['styleSrcElem', 'example.com', 'style-src-elem'],
    ['styleSrcAttr', 'example.com', 'style-src-attr'],
    ['workerSrc', 'example.com', 'worker-src'],
    ['baseUri', 'example.com', 'base-uri'],
    ['sandbox', 'example.com', 'sandbox'],
    ['formAction', 'example.com', 'form-action'],
    ['frameAncestors', 'example.com', 'frame-ancestors'],
    ['reportTo', 'example.com', 'report-to'],
    ['requireTrustedTypesFor', 'example.com', 'require-trusted-types-for'],
    ['trustedTypes', 'example.com', 'trusted-types'],
    ['upgradeInsecureRequests', 'example.com', 'upgrade-insecure-requests'],
    ['blockAllMixedContent', 'example.com', 'block-all-mixed-content'],
    ['reportUri', 'example.com', 'report-uri'],
]);
