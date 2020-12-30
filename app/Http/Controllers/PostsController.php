<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PostsController extends Controller {

    public function show() {
        return view('posts/show');
    }

}