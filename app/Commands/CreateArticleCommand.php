<?php

namespace App\Commands;

class CreateArticleCommand
{
    /** @var string $title */
    protected $title;

    /** @var string $body */
    protected $body;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }
}
