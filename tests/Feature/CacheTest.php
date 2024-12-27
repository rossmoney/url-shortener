<?php
use Illuminate\Support\Facades\Cache;

test('cache mockery test', function () {
    Cache::shouldReceive('get')
        ->once()
        ->with('cacheTest')
        ->andReturn('hello');

    expect(Cache::get('cacheTest'))->toBe('hello');
});