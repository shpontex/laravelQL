<?php

namespace Shpontex\LaravelQL\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelQLFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'make';
    }
}
