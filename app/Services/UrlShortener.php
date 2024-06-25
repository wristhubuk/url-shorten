<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;

class UrlShortener
{
    /**
     * Long URL to a short URL
     *
     * @param string $longUrl Original Long URL that needs to be shortened.
     * @return string The generated Short URL.
     *
     * */
    public function encode(string $longUrl): string
    {
        $shortCode = $this->generateShortCode();

        // Store the mapping in Laravel's cache system for 1 day
        Cache::put('url_' . $shortCode, $longUrl, now()->addDay());
        return 'http://short.est/' . $shortCode;
    }

    /**
     * Decode the Short URL to its Original Long URL
     *
     * @param string $shortCode The short code associated with the long URL.
     * @return string|null The original long URL if found, or null if the short code doesn't exist.
     *
     * */
    public function decode(string $shortCode): ?string
    {
        // Get the long URL from Laravel's built-in cache system
        return Cache::get('url_' . $shortCode);
    }

    /**
     * Create a unique short code for the URL using php random_bytes
     *
     * @return string The generated short code
     * */
    private function generateShortCode(): string
    {
        return substr(bin2hex(random_bytes(3)), 0, 6);
    }
}
