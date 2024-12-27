<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'short_url'];

    public static function shorten($originalUrl)
    {
        $links = Cache::get('links');
        if (empty($links)) {
            $links = new Collection();
        }
        $link = Link::getByOriginalUrl($originalUrl);
        if (empty($link)) {
            $link = new self();
            $link->original_url = $originalUrl;
            $link->id = count($links) + 1;
            $link->short_url = 'http://short.est/' . Hashids::encode($link->id, rand(0, 1000));
            $links->push($link);
        }
        Cache::put('links', $links);
        return $link;
    }

    public static function fromShortened($shortUrl)
    {
        $linkId = Hashids::decode(Str::replace("http://short.est/", "", $shortUrl));

        if (count($linkId) > 0) {
            $linkId = $linkId[0];
            return Link::getById($linkId);
        }
 
        return null;
    }

    public static function getLinks()
    {
        return Cache::get('links');
    }

    public static function getByOriginalUrl($url)
    {
        $links = Cache::get('links');

        if (empty($links)) {
            return null;
        }

        return $links->filter(function($item) use ($url) {
            return $item->original_url == $url;
        })->first();
    }

    public static function getById($id)
    {
        $links = Cache::get('links');

        if (empty($links)) {
            return null;
        }

        return $links->filter(function($item) use ($id) {
            return $item->id == $id;
        })->first();
    }
}