<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function encode(Request $request)
    {
        if (empty($request->input('url'))) {
            abort(400);
        }

        $originalUrl = $request->input('url');
        $link = Link::shorten($originalUrl);

        return response()->json($link);
    }

    public function decode(Request $request)
    {
        if (empty($request->input('url'))) {
            abort(400);
        }
        
        $url = $request->input('url');
        $link = Link::fromShortened($url);

        if (empty($link) || empty($link->original_url)) {
            abort(404);
        }

        return response()->json($link);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::getLinks();
        return response()->json($links);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $link = Link::getById($id);
        return response()->json($link);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}
