<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function encode(Request $request)
    {
        $request->validate(['url' => 'required|url']);
        $shortCode = Str::random(6);
        $shortUrl = ShortUrl::create(['original_url' => $request->url, 'short_code' => $shortCode]);
        return response()->json(['short_url' => url('/') . '/' . $shortUrl->short_code]);
    }

    public function decode($code)
    {
        $shortUrl = ShortUrl::where('short_code', $code)->first();
        return $shortUrl ? response()->json(['original_url' => $shortUrl->original_url]) 
                         : response()->json(['error' => 'Short URL not found'], 404);
    }
}
