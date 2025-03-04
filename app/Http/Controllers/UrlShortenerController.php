<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    /**
     * Encode a URL into a short URL.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function encode(Request $request)
    {
        // Validate the URL
        $request->validate(['url' => 'required|url']);

        // Generate a random short code
        $shortCode = Str::random(6);

        // Save the URL in the database with the short code
        $shortUrl = ShortUrl::create([
            'original_url' => $request->url,
            'short_code' => $shortCode
        ]);

        // Return the shortened URL as a JSON response
        return response()->json(['short_url' => $shortUrl->short_code]);
    }

    /**
     * Decode the short URL and retrieve the original URL.
     *
     * @param string $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function decode($code)
    {
        // Find the record with the matching short code
        $shortUrl = ShortUrl::where('short_code', $code)->first();

        // If the short URL exists, return the original URL
        if ($shortUrl) {
            return response()->json(['original_url' => $shortUrl->original_url]);
        }

        // If not found, return a 404 error page
        return response()->json(['error' => 'Short URL not found'], 404);
    }

    /**
     * Redirect to the original URL from the short code.
     *
     * @param string $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($code)
    {
        // Find the record with the matching short code
        $shortUrl = ShortUrl::where('short_code', $code)->first();

        // If the short URL exists, redirect to the original URL
        if ($shortUrl) {
            return redirect()->to($shortUrl->original_url);
        }

        // If not found, return a 404 error page
        return abort(404, 'Short URL not found');
    }
}
