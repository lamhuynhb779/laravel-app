<?php

namespace App\Handlers;

use App\Models\Article;
use Illuminate\Console\Command;

class CreateArticleHandler
{
    public function handle(Command $command)
    {
        try {
            // Handle create Article logic here
            return Article::create([
                'title' => $command->title ?? null,
                'body'  => $command->body ?? null,
            ]);
        } catch (\Exception $e) {
            // throws exception here
            return null;
        }
    }
}
