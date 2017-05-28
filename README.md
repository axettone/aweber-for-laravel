# aweber-for-laravel
by Paolo Niccolò Giubelli <paoloniccolo.giubelli@itestense.it>

Integrate AWeber into your Laravel application via AWeber API v.1.0

## Warning
This library is not ready for production environment. Feel free to give it a try!

## The library

### API throttling

AWeber APIs are limited to 60 requests per minute, so it is required to put some `sleep(1)` in the code. This is why it would be great to use a callback approach whenever it's possibile.

### API documentation

Offical AWeber API documentation can be found [here](https://labs.aweber.com/docs/reference/1.0) as well as the API Map, that is a very useful. The goal of this work is to map the entire API Map.

### Coding standard

PSR-2

Fluent syntax

### Installing

You can use Composer:

    composer require axettone/aweber-for-laravel

and then you have to publish the assets:

    php artisan vendor:publish

### Getting your access token

In order to use AWeber APIs, you need to create an AWeber APP and get an access token. Take a look at [AWeber Documentation](https://labs.aweber.com/getting_started/main).

This library will help you get your token soon, but this feature is not available at this moment.

You also need to keep track of your Account ID and List IDs and put these values in the aweber.php config file.

### Lists

AWeber supports many lists for every account. Every list has an unique ID, but it's useful to refer to them using a name in your code. So in the aweber.php config file, you can set an array of lists using an indexed array:

    ...,
    lists = [
        'Customers' => 123456,
        'Suppliers' => 654321,
        ...
    ],
    ...

So you can get all the subscribers of these lists as follows:

    AWeber::getList('Customers')->subscribers()->all()->fetch()

## Usage

### Getting a list (one shot)

    $subscribers = AWeber::getList('Customers')->subscribers()->all()->fetch();

### Getting a list (callback)

    $onUpdate = function($subscribers) {
        //Called every 100 subscribers
        //...
    }
    $onFinish = function($subscribers) {
        //Called on finish
    }
    AWeber::getList('Customers')->subscribers()->all()->fetch($onUpdate, $onFinish);

### Un/Tagging subscribers

    //Tagging / Untagging all subscribers in a list
    AWeber::getList('Customers')->subscribers()->all()->tag([<tags_to_add>],[<tags_to_remove>]);

    //Tagging / Untagging all subscribers a specific subscriber
    AWeber::getList('Customers')->subscribers()->find(<id>)->tag([<tags_to_add>],[<tags_to_remove>]);
