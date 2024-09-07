<?php

use ErickJMenezes\Policyman\CSPParser;
use ErickJMenezes\Policyman\CSPSerializer;

test('it can parse large CSP headers and serialize to string again', function () {
    $hugeCSPHeader = "Content-Security-Policy: default-src 'self' *.test-example.com.br; connect-src 'self' test-service0.com.br *.test-service1.com *.test-service2.com *.test-service4.com *.test-example.com.br wss://test-service6.test-example.com.br wss://broker.test-example.com.br:9443/ test-storage.test-service5.com *.test-service6.com px.test-service7.com www.test-service8.com *.test-service9.ms *.test-service10.net www.test-service11.com bat.test-service12.com maps.test-service13.com *.test-service14.com *.test-service14.com.br; script-src 'self' 'unsafe-inline' 'unsafe-eval' *.test-service4.com *.test-example.com.br cdn.test-service15.net *.test-service1.com static.test-service16.com www.test-service14.com script.test-service16.com snap.test-service-17.com connect.test-service11.net bat.test-service12.com www.test-service9.ms www.test-service8.com test-service14ads.g.test-service10.net js.test-service-18.com test-service-19.com maps.test-service13.com *.test-service-22.com *.test-service14.com *.test-service-20.com; style-src 'self' 'unsafe-inline' *.test-service4.com *.test-example.com.br *.test-service1.com fonts.test-service-21.net cdn.test-service15.net fonts.test-service13.com *.test-service-22.com; child-src 'self' *.test-service10.net *.test-service-24.net *.test-service14.com *.test-example.com.br app.test-service-23.com; img-src 'self' *.test-service1.com *.test-service-25.com *.test-service15.net *.test-example.com.br test-storage.test-service5.com pos.test-service-26.com px.test-service7.com *.test-service14.com.br *.test-service14.com *.test-service8.com *.test-service11.com bat.test-service12.com www.test-service14.com maps.test-service-22.com maps.test-service13.com www.test-service-25.com blob: data:; font-src 'self' fonts.test-service13.com fonts.test-service-21.net *.test-service1.com *.test-service-22.com blob: data:";
    $headerHash = md5($hugeCSPHeader);
    $parser = new CSPParser();
    $result = $parser->parse($hugeCSPHeader);
    $serializer = new CSPSerializer();
    $newHeader = $serializer->serialize($result);
    $newHeaderHash = md5($newHeader);
    expect($newHeaderHash)->toBe($headerHash);
});
