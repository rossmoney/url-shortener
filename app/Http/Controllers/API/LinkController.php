<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="URL Shortener",
 *     version="1.0.0"
 * )
 */
class LinkController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/encode",
     *     summary="Encode a URL into a short form",
     *     @OA\Parameter(
     *         name="url",
     *         in="query",
     *         description="URL to shorten",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     tags={"Link"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function encode(Request $request)
    {
        if (empty($request->input('url'))) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        $originalUrl = $request->input('url');
        $link = Link::shorten($originalUrl);

        return response()->json($link);
    }

    /**
     * @OA\Post(
     *     path="/api/decode",
     *     summary="Decode a shortened URL into the original", 
     *     @OA\Parameter(
     *         name="url",
     *         in="query",
     *         description="Short URL (http://short.est/e58h6j)",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     tags={"Link"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request"),
     *     @OA\Response(response=404, description="URL Not Found!")
     * )
     */
    public function decode(Request $request)
    {
        if (empty($request->input('url'))) {
            return response()->json(['message' => 'Invalid request'], 400);
        }
        
        $url = $request->input('url');
        $link = Link::fromShortened($url);

        if (empty($link) || empty($link->original_url)) {
            return response()->json(['message' => 'URL Not Found!'], 404);
        }

        return response()->json($link);
    }

    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/links",
     *     summary="Return all stored links",
     *     tags={"Link"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $links = Link::getLinks();
        return response()->json($links);
    }

    /**
     * Display the specified resource.
     */
    /**
     * @OA\Get(
     *     path="/api/links/{id}",
     *     summary="Return a single stored link by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of URL to return",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     tags={"Link"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="ID not found")
     * )
     */
    public function show($id)
    {
        $link = Link::getById($id);
        if (empty($link)) {
            return response()->json(['message' => 'ID not found'], 404);
        }
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
