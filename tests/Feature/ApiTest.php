<?php
use Illuminate\Support\Facades\Cache;

test('encode new url https://google.com then decode and check url matches original', function () {
    Cache::flush();
    $url = 'https://google.com';
    $response = $this->post('/api/encode', ['url' => $url]);
    $shortUrl = $response->getData()->short_url;
    $id = $response->getData()->id;

    $response = $this->post('/api/decode', ['url' => $shortUrl]);

    $response->assertExactJson(['id' => $id, 'original_url' => $url, 'short_url' => $shortUrl]);
});