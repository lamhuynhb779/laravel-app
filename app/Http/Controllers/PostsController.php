<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Transformers\PostTransformer;

class PostsController extends Controller {

    protected $postTransformer;

    function __construct(PostTransformer $postTransformer)
    {
        $this->postTransformer = $postTransformer;
    }

    public function show() {
        return view('posts/show');
    }

    public function getPost()
    {
        # code...
        $post = Post::with('user')->first();
        return $this->postTransformer->transform($post);
    }

}
