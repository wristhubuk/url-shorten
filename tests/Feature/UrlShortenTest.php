<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase;
use App\Services\UrlShortener;

class UrlShortenTest extends TestCase
{
   protected UrlShortener $urlShortener;

   /*
    * Set up the Testing Environment
    */
   public function setUp(): void
    {
        parent::setUp();
        $this->urlShortener = new UrlShortener();
    }

    /*
     * Test encoding the Long URL to Short URL and ensure the UrlShortener encode method works
     */
   public function test_encodeURL()
   {
       $longURL = 'https://www.thisisalongdomain.com/with/some/parameters?and=here_too';
       $shortURL = $this->urlShortener->encode($longURL);

       //Return the Short URL and needs to match the correct format
       $this->assertStringContainsString('http://short.est/', $shortURL);
   }

   /*
    * Test to decode the Short URL back into the original Long URL (verify the method within URL Shortener is working as it should)
    */
   public function test_decodeURL()
   {
       $longURL = 'https://www.thisisalongdomain.com/with/some/parameters?and=here_too';
       $shortUrl = $this->urlShortener->encode($longURL);

       //Get the code from the Short URL
       $shortCode = substr($shortUrl, strlen('http://short.est/'));

       //Decode the Short URL and get the original Long URL
       $decodedLongURL = $this->urlShortener->decode($shortCode);

       //Ensure the decoded long URL matches the original long URL
       $this->assertEquals($longURL, $decodedLongURL);
   }
}
