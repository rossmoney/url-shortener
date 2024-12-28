# URL Shortener

## Brief

Create a URL shortening service where you enter a URL such as https://www.thisisalongdomain.com/with/some/parameters?and=here_too and it returns a short URL such as http://short.est/GeAi9K.

## Starting the project
Copy .env.example to .env
> cp .env.example .env

Open the project and in the terminal type: 
> php artisan key:generate
> composer install

> php artisan migrate

do you want to create db? - yes
> php artisan serve

## Running the project
### API Endpoints
#### POST
http://127.0.0.1:8000/api/encode - encode a url, return shortened version from original
Example: 'url' 
http://127.0.0.1:8000/api/decode - decode a url, return original from shortened version

#### GET
http://127.0.0.1:8000/api/links - view all stored links
http://127.0.0.1:8000/api/links/1 - view link by id

### API Documentation
Swagger Documentation can be accessed at http://127.0.0.1:8000/api/documentation
To regenerate docs run 
> php artisan l5-swagger:generate

#### Frontend 
http://127.0.0.1:8000/ - encoder form
http://127.0.0.1:8000/decoder - decoder form


## Testing the project

Run in the project directory
> vendor/bin/pest

