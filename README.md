# URL Shortener Service

This is a basic URL Shortener Service built using Laravel. It provides end points to Encode Long URLs into Short URLs and decode Short URLs back to their original Long format.

## Setup

1. Clone the repository
2. Run `composer install`
3. Start the server using `php artisan serve`

## API Endpoints

1. **Encode URL**
- URL: '/api/encode'
- Method: POST
- Body
- ```json 
  { "url": "https://www.thisisalongdomain.com/with/some/parameters?and=here_too" }
- Response
- ```json
  { "short_url": "http://short.est/3dde86" }
    

2. **Decode URL**
- URL: '/api/decode'
- Method: GET
- Body
- ```json 
  { "url": "http://short.est/3dde86" }
- Response
- ```json
  { "long_url": "https://www.thisisalongdomain.com/with/some/parameters?and=here_too" }

## Testing

Testing for the URL Shortening Service was done using Postman. Further Feature testing can be done for more advanced testing if required.


