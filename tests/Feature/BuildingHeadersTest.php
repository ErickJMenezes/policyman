<?php

use ErickJMenezes\Policyman\Keyword;
use ErickJMenezes\Policyman\Policyman;

test('must build a simple header', function () {
   $header = Policyman::builder()
       ->defaultSrc([Keyword::Self, '*.cdn.test'])
       ->toString();

   expect($header)
       ->toBe("Content-Security-Policy: default-src 'self' *.cdn.test");
});
