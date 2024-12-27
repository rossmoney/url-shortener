<?php
use Illuminate\Support\Facades\Cache;

test('encode no url present', function () {
    Cache::flush();
    $response = $this->post('/api/encode');

    $response->assertStatus(400);
});

test('decode no url present', function () {
    Cache::flush();
    $response = $this->post('/api/decode');

    $response->assertStatus(400);
});

test('encode url present', function () {
    Cache::flush();
    $response = $this->post('/api/encode', ['url' => 'https://google.com']);

    $response->assertStatus(200);
});

test('decode url present', function () {
    Cache::flush();
    $response = $this->post('/api/decode', ['url' => 'https://google.com']);

    $response->assertStatus(404);
});
