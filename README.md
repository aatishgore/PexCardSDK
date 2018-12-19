# PEX CARD PHP SDK
This is a PEX CARD PHP SDK to trigger the api



[View tutorial](https://developer.pexcard.com/docs4)

## Usage
- Install package

```
composer require aatishgore/PexCardSDK
```
- Publish Vendor

```
php artisan vendor:publish
```

- When it's done you need to configure your env file and set your app key and other necessary details. In your terminal type:

```
cp .env.example .env
```

- generate the app key

```
php artisan key:generate
```
- create a folder called `packages`, then create a new folder called samuelayo. 
> Note that you can subtitute samuelayo with your own vendor name. Be sure to change the refrence in every other aspect of the app

- clone this repository to the newly created folder

```
git clone https://github.com/samuelayo/contact-form-package.git packages/samuelayo/contactform
```
- Tell Laravel how to load our package and use it's functions, so inside the root of your Laravel app in the composer.json add this code:

```

"autoload": {
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "psr-4": {
            "Samuelayo\\Contactform\\": "packages/samuelayo/contactform/src",
            "App\\": "app/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Samuelayo\\Contactform\\": "packages/samuelayo/contactform/src",
            "Tests\\": "tests/"
        }
    },
```
- Dump the composer autoloader

```
composer dump-autoload
```

- Next, we need to add our new Service Provider in our `config/app.php` inside the `providers` array:

```
'providers' => [
         ...,
            App\Providers\RouteServiceProvider::class,
            // Our new package class
            Samuelayo\Contactform\ContactFormServiceProvider::class,
        ],
```
- Migrate the database tables

```
php artisan migrate
```

And finally, start the application by running:

```
php artisan serve
```

Visit http://localhost:8000/contact in your browser to view the demo.

If you want to include the project as a package to your app, run:

```
composer require samuelayo/contactform
```

## Built With

* [Laravel](https://laravel.com/) - The PHP framework for web artisans.
        