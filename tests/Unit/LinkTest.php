<?php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use App\Models\Link;
use Vinkla\Hashids\Facades\Hashids;

test('App\Models\Link::shorten() test', function () {
    Cache::shouldReceive('get')
        ->twice()
        ->with('links')
        ->andReturn(collect());

    Cache::shouldReceive('put')
        ->once()
        ->with('links', Mockery::any())
        ->andReturn(collect());

    Hashids::shouldReceive('encode')
        ->once()
        ->with(1, Mockery::any())
        ->andReturn('jR');

    $link = Link::shorten('https://google.com');

    expect($link->short_url)->toBe('http://short.est/jR');
});

test('App\Models\Link::fromShortened() test', function () {
    $link = new Link();
    $link->id = 1;
    $link->short_url = 'http://short.est/jR';
    $link->original_url = 'https://google.com';
    $links = new Collection();
    $links->push($link);

    Cache::shouldReceive('get')
        ->twice()
        ->with('links')
        ->andReturn($links);

    Hashids::shouldReceive('decode')
        ->once()
        ->with('jR')
        ->andReturn([0 => 1]);

    $link = Link::fromShortened('http://short.est/jR');

    expect($link->original_url)->toBe('https://google.com');
});