<?php

namespace App\Facades\JsonPlaceholder;

use Illuminate\Support\Facades\Facade;

class JsonPlaceholderAPI extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        // This method's job is to return the name of a service container binding

        return 'JsonPlaceholderAPI';
    }
}
