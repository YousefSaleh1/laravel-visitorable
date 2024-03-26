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

## Usage

In order to mark a model as "visitorable", import the [Visitorable] trait.
