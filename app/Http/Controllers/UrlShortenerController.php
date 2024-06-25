<?php
namespace App\Http\Controllers;

use App\Services\UrlShortener;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UrlShortenerController extends Controller
{
    /**
     * URL Shortener Service
     *
     * @var UrlShortener
     */
    private UrlShortener $urlShortener;

    /**
     * New Controller Instance
     *
     * @param UrlShortener $urlShortener The URL Shortener service.
     *
     */
    public function __construct(UrlShortener $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

    /**
     * Encode Long URL to Short URL
     *
     * @param Request $request The HTTP request containing the Long URL.
     * @return JsonResponse The JSON response containing the Short URL.
     */
    public function encode(Request $request): JsonResponse
    {
        //Validate the request
        //Url field required and must be in correct URL Format
        $request->validate([
            'url' => 'required|url'
        ]);

        $longUrl = $request->input('url');
        $shortUrl = $this->urlShortener->encode($longUrl);

        return response()->json(['short_url' => $shortUrl]);
    }

    /**
     * Decode the Short URL to Original long URL
     *
     * @param Request $request HTTP request containing the short URL.
     * @return JsonResponse JSON response containing the long URL or an error message.
     */
    public function decode(Request $request): JsonResponse
    {
        $shortUrl = $request->input('url') ?? $request->query('url');

        if (empty($shortUrl)) {
            return response()->json(['error' => 'URL parameter is required'], 400);
        }

        // Extract the code from the URL
        $shortCode = basename(parse_url($shortUrl, PHP_URL_PATH));

        $longUrl = $this->urlShortener->decode($shortCode);

        if ($longUrl === null) {
            return response()->json(['error' => 'Short URL not found'], 404);
        }
        return response()->json(['long_url' => $longUrl]);
    }
}
