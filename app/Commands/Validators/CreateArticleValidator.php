<?php

namespace App\Commands\Validators;

use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

class CreateArticleValidator implements Middleware
{
    /** @var string[] $rules */
    protected $rules = [
        'title' => 'required',
        'body' => 'required|min:1|max:255',
    ];

    public function execute($command, callable $next)
    {
        $validator = Validator::make((array) $command, $this->rules);
        if ($validator->failed()) {
            // throw ex
            return $validator->errors();
        }
        return $next($command);
    }
}
