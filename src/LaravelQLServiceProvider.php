<?php

namespace Shpontex\LaravelQL;

use Illuminate\Support\ServiceProvider;

class LaravelQLServiceProvider extends ServiceProvider
{
    // public function __construct($data)
    // {
    //     return 'ok';
    // }

    public function boot()
    {
        // code...
    }

    public function register()
    {
        $this->app->bind('make', function () {
            return new LaravelQL();
        });
    }
}
