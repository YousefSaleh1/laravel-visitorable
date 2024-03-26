# laravel-visitorable
Provides an attribute to allow counting the number of visitors for multiple models within your Laravel app


## Installation

You can install the package via composer:

```bash
composer require devyousef/visitor
```

You can publish the migrations with:

```bash
php artisan vendor:publish --provider="Devyousef\Visitor\Providers\VisitorServiceProvider" --tag="migrations"
```

After that run the migrations:

```bash
php artisan migrate
```

As with most Laravel packages, if you're using Laravel 5.5 or later, the package will be auto-discovered ([learn more if this is new to you](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518)).

If you're using a version of Laravel before 5.5, you'll need to register the Rateable *service provider*. In your `config/app.php` add `Devyousef\Visitor\Providers\VisitorServiceProvider` to the end of the `$providers` array.

````php
'providers' => [

    Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
    Illuminate\Auth\AuthServiceProvider::class,
    ...
    Devyousef\Visitor\Providers\VisitorServiceProvider::class,

],
````

## Usage

In order to mark a model as "visitorable", import the `Visitorable` trait.

```php
<?php

namespace App\Models;

use Devyousef\Visitor\Traits\Visitorable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Visitorable;
    //
}
```
Now, your model has access to a few additional methods.

Now to calculate the number of visitors  when visiting a post, for example we use `visit()` . Note that the user must be added as a parameter:

```php
$post = Post::first();
$user = Auth::user();
$post->visit($user);
```

Then to display the number of visitors we use `visitorCount()`

```php
$postVisitor = Post::first()->visitorCount();
dd($postVisitor);
```
