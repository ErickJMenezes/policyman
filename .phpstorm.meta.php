<?php

namespace PHPSTORM_META {
    expectedArguments(
        \ErickJMenezes\Policyman\PolicyDirective::rename(),
        0,
        argumentsSet('allowed-directives')
    );

    expectedArguments(
        \ErickJMenezes\Policyman\PolicyDirective::__construct(),
        0,
        argumentsSet('allowed-directives')
    );

    expectedArguments(
        \ErickJMenezes\Policyman\PolicyDirective::validateDirectiveName(),
        0,
        argumentsSet('allowed-directives')
    );


    expectedArguments(
        \ErickJMenezes\Policyman\ContentSecurityPolicy::find(),
        0,
        argumentsSet('allowed-directives')
    );

    expectedArguments(
        \ErickJMenezes\Policyman\ContentSecurityPolicy::remove(),
        0,
        argumentsSet('allowed-directives')
    );

    registerArgumentsSet(
        'allowed-directives',

        'child-src',
        'connect-src',
        'default-src',
        'fenced-frame-src',
        'font-src',
        'frame-src',
        'img-src',
        'manifest-src',
        'media-src',
        'object-src',
        'prefetch-src',
        'script-src',
        'script-src',
        'script-src-attr',
        'style-src',
        'style-src-elem',
        'style-src-attr',
        'worker-src',
        'base-uri',
        'sandbox',
        'form-action',
        'frame-ancestors',
        'report-to',
        'require-trusted-types-for',
        'trusted-types',
        'upgrade-insecure-requests',
        'block-all-mixed-content',
        'report-uri',
    );
}
